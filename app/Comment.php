<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comments';

  protected $fillable = [
    'body'
  ];

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function submission() {
    return $this->belongsTo('App\Submission', 'submission_id');
  }

  public function getCommentAuthor($userId) {
    return User::where('id', $userId)
      ->get();
  }
}
