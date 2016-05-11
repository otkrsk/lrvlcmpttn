<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
  protected $table = 'submissions';

  protected $fillable = [
    'is_winner'
  ];

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

  public function getAuthor(Submission $submission) {
    return $submission->user->name;
  }

  public function isWinner() {
    return $this->belongsToMany('App\Competition', 'competition_submission', 'submission_id', 'competition_id');
  }

  public function getCompetitionId(Submission $submission) {
    return $submission->competition_id;
  }

}
