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

}
