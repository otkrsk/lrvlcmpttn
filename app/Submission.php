<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
  protected $table = 'submissions';

  public function competition() {
    return $this->belongsTo('App\Competition', 'competition_id');
  }

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function likes() {
    return $this->morphMany('App\Like', 'likeable');
  }

  public function comments() {
    return $this->hasMany('App\Comment', 'submission_id');
  }

  public function getComments(Submission $submission) {
    // dd($submission->comments);
    // return $submission->comments->where('submission_id', $submission->id);
    // return $submission->comments->sortByDesc('created_at');
    return $submission->comments;
  }

}
