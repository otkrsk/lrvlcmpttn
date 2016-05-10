<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
  protected $table = 'competitions';

  protected $fillable = [
    'is_open'
  ];

  public function submission() {
    return $this->hasMany('App\Submission');
  }

  public function hasWinner() {
    return $this->belongsToMany('App\Submission', 'competition_submission', 'competition_id', 'submission_id');
  }
}
