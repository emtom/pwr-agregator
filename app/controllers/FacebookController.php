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
	    return Redirect::away($this->facebook->getLoginUrl($params));

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

		$stream = $this->facebook->api('/me?fields=home');

		//echo "<pre>";

		foreach( $stream['home']['data'] as $key => &$post ) {

			if( isset($post['object_id']) ) {
				$new_photo = $this->facebook->api('/'.$post['object_id']);

				//print_r($new_photo);
				$post['picture'] = $new_photo['images'][1]['source'];
			}
			if( isset($post['from']) ) {

				$fb_user = $this->facebook->api('/'.$post['from']['id']);
				$post['from']['link_to'] = $fb_user['link'];

			}
			if( isset($post['to']) ) {
				$fb_target_user = $this->facebook->api('/'.$post['to']['data'][0]['id']);
				$post['to']['data'][0]['link_to'] = $fb_target_user['link'];
			}

		} // foreach

		return $stream;
	}
	public function register() {

		echo "register";

	}


}
