<?php

namespace App;

use App\Submission;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function submission() {
    return $this->hasMany('App\Submission');
  }

  public function hasLikedSubmission(Submission $submission) {
    return (bool) $submission->likes
      ->where('likeable_id', $submission->id)
      ->where('likeable_type', get_class($submission))
      ->where('user_id', $this->id)
      ->count();
  }

  public function likes() {
    return $this->hasMany('App\Like', 'user_id');
  }

}
