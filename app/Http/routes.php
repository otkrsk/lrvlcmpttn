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
  Route::resource('competition', 'CompetitionController');
  Route::get('submission/{submissionId}/like', ['uses' => 'SubmissionController@getLike', 'as' => 'submission.like']);
  Route::get('submission/{submissionId}/unlike', ['uses' => 'SubmissionController@unLike', 'as' => 'submission.unlike']);
  Route::resource('submission', 'SubmissionController');
});

Route::auth();
