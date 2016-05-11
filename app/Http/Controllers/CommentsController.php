<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Submission;

class CommentsController extends Controller
{
  public function postComment(Request $request) {
    Auth::user()->comments()->create([
      'body' => $request->input('comment'),
    ]);

    return redirect()->back();
  }

  public function edit($id) {
    $comment = Comment::find($id);

    return view('comments.edit', compact('comment'));
  }

  public function update(Request $request, $id) {
    // dd($request);
    $comment = Comment::find($id);

    $comment->body = $request->body;

    $comment->save();

    $submission = Submission::find($comment->submission_id);
    $competition_id = $submission->getCompetitionId($submission);

    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }

  public function redirect($id) {
    $comment = Comment::find($id);
    $submission = Submission::find($comment->submission_id);
    $competition_id = $submission->getCompetitionId($submission);

    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }

  public function delete($id) {
    $comment = Comment::find($id);
    return view('comments.delete', compact('comment'));
  }

  public function destroy($id) {
    $comment = Comment::find($id);

    $submission = Submission::find($comment->submission_id);
    $competition_id = $submission->getCompetitionId($submission);

    $comment->delete();
    return redirect()->action('CompetitionController@show', ['id' => $competition_id]);
  }
}
