<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
  public function postComment(Request $request) {
    Auth::user()->comments()->create([
      'body' => $request->input('comment'),
    ]);

    return redirect()->back();
  }
}
