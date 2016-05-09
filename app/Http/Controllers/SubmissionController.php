<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\Http\Requests;
use App\Submission;
use App\Competition;
use App\User;

class SubmissionController extends Controller
{
  public function index() {
    $submissions = Submission::all();
    return view('submission.index', compact('submissions'));
  }

  public function create() {
    return view('submission.create');
  }

  public function store(Request $request) {
    $submission = new Submission;

    $competition = Competition::find($request->competition_id);
    $user = User::find(Auth::user()->id);

    $submission->name = $request->name;
    $submission->save();

    $competition->submission()->save($submission);
    $user->submission()->save($submission);

    return redirect()->action('CompetitionController@show', ['id' => $request->competition_id]);
  }

  public function getLike($submissionId) {
    // dd($submissionId);

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

    // $submission->likes()->detach($submission);

    DB::table('likeable')->where('likeable_id', $submission->id)
      ->where('likeable_type', get_class($submission))
      ->where('user_id', Auth::user()->id)
      ->delete();

    return redirect()->back();
  }

}
