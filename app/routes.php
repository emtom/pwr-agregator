<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/home', 'HomeController@index' );
Route::get('/', 'HomeController@index' );
Route::get('/fblogin', 'FacebookController@login' );
Route::get('/fbregister', 'FacebookController@register' );
Route::get('/logout', 'UserController@logout' );
Route::get('/profile', 'UserController@profile');

Route::get('/fbstream', 'FacebookController@getStream');
Route::get('/stream', 'StreamController@getStream');

Route::get('login/fb/callback', 'FacebookController@loginCallback');


Route::get('/twitterstream2', function() {


	// echo "<pre>";
	// //print_r( Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json')) );
	// $rAr = json_decode( Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json')) );

	// print_r( $rAr );


	// // $new = json_decode( Twitter::getHomeTimeline(array('count' => 20, 'max_id' => $last_id, 'format' => 'json')) );

	// // $r = array_merge($rAr, $new);

	// // echo count($r);

});


// /* instagram helper */
// Route::get('/users/authorize', array('as' => 'authorize', 'uses' => 'UsersController@getAuthorize'));
// Route::get('/login', array('as' => 'login', 'uses' => 'UsersController@getLogin'));
// Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@getLogout'));

