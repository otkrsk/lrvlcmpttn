<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use Auth;
use DB;
use App\Http\Requests;

use App\Comment;
use App\Competition;
use App\Submission;
use App\User;

class SubmissionController extends Controller
{
  public function index() {
    $submissions = Submission::all();
    return view('submission.index', compact('submissions'));
  }

  public function create() {
    $competition = Competition::find($_GET['competition']);

    if(!$competition->is_open) {
      return redirect()
              ->back()
              ->with('info', 'Competition has been closed.');
    }

    if(isset($_GET['type'])) {
      $type = $_GET['type'];

      switch ($_GET['type']) {
        case 'web':
          return view('submission.create_web', compact('competition', 'type'));
          break;

        case 'photo':
          return view('submission.create_photo', compact('competition', 'type'));
          break;

        default:
          break;
      }
    }

    return view('submission.create', compact('competition'));
  }

  public function edit($id) {
    $submission = Submission::find($id);
    return view('submission.edit', compact('submission'));
  }

  public function store(Request $request) {
    $rawfile = $request->file('file_name');
    $file = Image::make($rawfile);
    $file->save(base_path() . '/public/' . $rawfile->getClientOriginalName());

    $submission = new Submission;
    $competition = Competition::find($request->competition_id);
    $user = User::find(Auth::user()->id);

    $submission->type = $request->submission_type;
    $submission->name = $request->name;
    $submission->description = $request->description;
    $submission->file_name = $rawfile->getClientOriginalName();
    $submission->file_path = $rawfile->getClientOriginalName();
    $submission->save();

    $competition->submission()->save($submission);
    $user->submission()->save($submission);

    return redirect()->action('CompetitionController@show', ['id' => $request->competition_id]);
  }

  public function update(Request $request, $id) {
    $submission = Submission::find($id);

    $submission->name = $request->name;
    $submission->description = $request->description;

    if($request->file('file_name')) {
      $rawfile = $request->file('file_name');
      $file = Image::make($rawfile);
      $file->save(base_path() . '/public/' . $rawfile->getClientOriginalName());

      $submission->file_name = $rawfile->getClientOriginalName();
      $submission->file_path = $rawfile->getClientOriginalName();
    }

    $submission->save();

    $competition_id = $submission->getCompetitionId($submission);

    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }

  public function redirect($id) {
    $submission = Submission::find($id);
    $competition_id = $submission->getCompetitionId($submission);

    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }

  public function delete($id) {
    $submission = Submission::find($id);
    return view('submission.delete', compact('submission'));
  }

  public function getLike($submissionId) {
    $submission = Submission::find($submissionId);

    if(!$submission) {
      return redirect()->route('/');
    }

    if(Auth::user()->hasLikedSubmission($submission)) {
      return redirect()->route('/');
    }

    $like = $submission->likes()->create([]);
    Auth::user()->likes()->save($like);

    return redirect()->back();
  }

  public function unLike($submissionId) {
    $submission = Submission::find($submissionId);

    DB::table('likeable')->where('likeable_id', $submission->id)
      ->where('likeable_type', get_class($submission))
      ->where('user_id', Auth::user()->id)
      ->delete();

    return redirect()->back();
  }

  public function postComment(Request $request, $submissionId) {
    $submission = Submission::find($submissionId);

    $comment = $submission->comments()->create([
      'body' => $request->input('comment'),
    ]);
    Auth::user()->comments()->save($comment);

    return redirect()->back();
  }

  public function selectWinner($submissionId) {
    $submission = Submission::find($submissionId);
    $submission->update(['is_winner' => 1]);

    return redirect()->back();
  }

  public function deSelectWinner($submissionId) {
    $submission = Submission::find($submissionId);
    $submission->update(['is_winner' => 0]);

    return redirect()->back();
  }

  public function destroy($id) {
    $submission = Submission::find($id);
    $competition_id = $submission->getCompetitionId($submission);

    $submission->delete();
    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }

}
