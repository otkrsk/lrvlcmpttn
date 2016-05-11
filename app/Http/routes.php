<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('/', 'HomeController@index');
  Route::get('/home', 'HomeController@index');
  Route::get('competition/create', 'CompetitionController@create');
  Route::get('competition/{id}/confirmclose', ['uses' => 'CompetitionController@confirmWinners', 'as' => 'competition.confirmclose']);
  Route::resource('competition', 'CompetitionController');
  Route::get('submission/{submissionId}/deselect', ['uses' => 'SubmissionController@deSelectWinner', 'as' => 'submission.deselect']);
  Route::get('submission/{submissionId}/select', ['uses' => 'SubmissionController@selectWinner', 'as' => 'submission.select']);
  Route::get('submission/{submissionId}/like', ['uses' => 'SubmissionController@getLike', 'as' => 'submission.like']);
  Route::get('submission/{submissionId}/unlike', ['uses' => 'SubmissionController@unLike', 'as' => 'submission.unlike']);
  Route::post('comments/post/{submissionId}', ['uses' => 'SubmissionController@postComment', 'as' => 'comments.post']);
  Route::get('submission/{id}/redirect', ['uses' => 'SubmissionController@redirect', 'as' => 'submission.redirect']);
  Route::get('submission/{submission}/delete', ['uses' => 'SubmissionController@delete', 'as' => 'submission.delete']);
  Route::resource('submission', 'SubmissionController');
  Route::get('comment/{id}/redirect', ['uses' => 'CommentsController@redirect', 'as' => 'comments.redirect']);
  Route::get('comment/{comment}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);
  Route::resource('comments', 'CommentsController');
});

Route::auth();
