<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Comment;
use App\Competition;
use App\Submission;

class CompetitionController extends Controller
{
  public function index() {
    $competitions = Competition::all();
    return view('competition.index', compact('competitions'));
  }

  public function show($id) {
    $competition = Competition::find($id);
    $submissions = Submission::where('competition_id', $id)->get();
    $winners = Submission::where('competition_id', $id)
                ->where('is_winner', true)
                ->get();

    // $comments = Comment::where(function($query) {
    //   return $query->where('submission_id', $submissions->id);
    // })->get();
    //
    // dd($comments);

    return view('competition.show', compact('competition', 'submissions', 'winners'));
  }

  public function edit($id) {
    $competition = Competition::find($id);
    return view('competition.edit', compact('competition'));
  }

  public function create() {
    return view('competition.create');
  }

  public function update(Request $request, $id) {
    $competition = Competition::find($id);

    $competition->name = $request->name;
    $competition->instructions = $request->instructions;
    $competition->title = $request->title;
    $competition->subtitle = $request->subtitle;

    $competition->save();

    return redirect()->action('CompetitionController@show', ['id' => $competition->id]);

  }

  public function store(Request $request) {
    $competition = new Competition;
    $competition->name = $request->name;
    $competition->instructions = $request->instructions;
    $competition->title = $request->title;
    $competition->subtitle = $request->subtitle;
    $competition->save();

    return redirect()->action('CompetitionController@index');
  }

  public function confirmWinners($id) {
    $competition = Competition::find($id);
    $winners = Submission::where('competition_id', $id)
                ->where('is_winner', true)
                ->get();

    foreach ($winners as $winner) {
      $winner->isWinner()->attach($id);
    }

    $competition->update(['is_open' => false]);

    return redirect()->back();
  }
}
