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
Route::get('/twstream', 'TwitterController@getStream');
Route::get('/stream', 'StreamController@getStream');

Route::get('login/fb/callback', 'FacebookController@loginCallback');

Route::get('instagram/getstream', 'InstagramController@getStream');
Route::get('instagram/connect', 'InstagramController@connect');
Route::get('instagram/authorize', 'InstagramController@authorize');
Route::get('instagram/disconnect', 'InstagramController@disconnect');


Route::get('/twitterstream2', function() {


	echo "<pre>";
	//print_r( Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json')) );
	//$rAr = Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json'));
	$rAr = Twitter::getFriends( array('format' => 'json'));

	//print_r( $rAr );
	$friendList = json_decode($rAr, true);

	$friendList = $friendList['users'];

	foreach($friendList as $key => &$friend) {
		$friend['type'] = 'tw';
	}

	print_r($friendList);

	// $new = json_decode( Twitter::getHomeTimeline(array('count' => 20, 'max_id' => $last_id, 'format' => 'json')) );

	// $r = array_merge($rAr, $new);

	// echo count($r);

});


Route::get('/twitter/connect', function()
{
    // your SIGN IN WITH TWITTER  button should point to this route
    $sign_in_twitter = TRUE;
    $force_login = FALSE;
    $callback_url = 'http://' . $_SERVER['HTTP_HOST'] . '/twitter/callback';
    //$callback_url = 'http://127.0.0.1/agregator/public/twitter/callback';
    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
    Twitter::set_new_config(array('token' => '', 'secret' => ''));
    $token = Twitter::getRequestToken($callback_url);
    dd($token);
    //$token = Twitter::getRequestToken();

    if( isset( $token['oauth_token_secret'] ) ) {
        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

        Session::put('oauth_state', 'start');
        Session::put('oauth_request_token', $token['oauth_token']);
        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

        return Redirect::to($url);
    }
    return Redirect::to('twitter/error');
});

Route::get('/twitter/callback', function() {
    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
    if(Session::has('oauth_request_token')) {
        $request_token = array(
            'token' => Session::get('oauth_request_token'),
            'secret' => Session::get('oauth_request_token_secret'),
        );

        Twitter::set_new_config($request_token);

        $oauth_verifier = FALSE;
        if(Input::has('oauth_verifier')) {
            $oauth_verifier = Input::get('oauth_verifier');
        }

        // getAccessToken() will reset the token for you
        $token = Twitter::getAccessToken( $oauth_verifier );
        if( !isset( $token['oauth_token_secret'] ) ) {
            return Redirect::to('/')->with('flash_error', 'We could not log you in on Twitter.');
        }

        $credentials = Twitter::query('account/verify_credentials');
        if( is_object( $credentials ) && !isset( $credentials->error ) ) {
            // $credentials contains the Twitter user object with all the info about the user.
            // Add here your own user logic, store profiles, create new users on your tables...you name it!
            // Typically you'll want to store at least, user id, name and access tokens
            // if you want to be able to call the API on behalf of your users.

            // This is also the moment to log in your users if you're using Laravel's Auth class
            // Auth::login($user) should do the trick.

            return Redirect::to('/')->with('flash_notice', "Congrats! You've successfully signed in!");
        }
        return Redirect::to('/')->with('flash_error', 'Crab! Something went wrong while signing you up!');
    }
});

Route::get('twitter/error', function(){
    echo "Something went wrong, add your own error handling here";
});


Route::get('flush', function(){
	Session::flush();
});
