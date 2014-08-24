<?php

class FacebookController extends \BaseController {


	private $facebook;

	public function __construct() {
		$this->facebook = new Facebook(Config::get('facebook'));
	}

	public function login() {

	    $params = array(
	        'redirect_uri' => url('/login/fb/callback'),
	        'scope' => 'email',
	    );
	    return Redirect::to($this->facebook->getLoginUrl($params));

	}

	public function loginCallback() {

		$uid = $this->facebook->getUser();
		$me = $this->facebook->api('/me');

	    $profile = Profile::whereUid($uid)->first();
	    if (empty($profile)) {

	        $user = new User;
	        $user->name = $me['first_name'].' '.$me['last_name'];
	        $user->email = $me['email'];
	        $user->photo = 'https://graph.facebook.com/'.$me['username'].'/picture?type=large';

	        $user->save();

	        $profile = new Profile();
	        $profile->uid = $uid;
	        $profile->username = $me['username'];
	        $profile = $user->profiles()->save($profile);
	    }

	    $profile->access_token = $this->facebook->getAccessToken();
	    $profile->save();

	    $user = $profile->user;

	    Auth::login($user);

	    return Redirect::to('/');

	}

	public function getInitialStream() {

		$stream = $this->facebook->api('/me?fields=home.limit(20)');

		return $stream;
	}
	public function register() {

		echo "register";

	}


}
