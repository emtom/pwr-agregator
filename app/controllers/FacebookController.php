<?php

use Facebook\FacebookSession;
use \LaravelFacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;

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

	public function getStream($getType, $paging = null) {

		switch($getType) {
			case 'initial':
				$stream = $this->getInitialStream();
				break;
			case 'scrolled':
				$stream = $this->getScrolledStream($paging);
				break;
		} // switch

		return $stream;
	}
	public function register() {

		echo "register";

	}

	private function getInitialStream() {

		$stream = $this->facebook->api('/me?fields=home');

		foreach( $stream['home']['data'] as $key => &$post ) {


			if( isset($post['object_id']) ) {

				try {
					$new_media = $this->facebook->api('/'.$post['object_id']);
					if( isset($new_media['images']) ) {
						$post['picture'] = $new_media['images'][1]['source'];
					} else if( isset( $new_media['format'])) {
						$post['video']['iframe'] = $new_media['format'][1]['embed_html'];
						$post['video']['picture'] = $new_media['format'][1]['picture'];
					}
				} catch (FacebookApiException $e) {}

			}
			if( isset($post['from']) ) {

				try {
					$fb_user = $this->facebook->api('/'.$post['from']['id']);
					if( isset( $fb_user['link'])) {
						$post['from']['link_to'] = $fb_user['link'];
					}
				} catch (FacebookApiException $e) {}

			}
			if( isset($post['to']) ) {

				try {
					$fb_target_user = $this->facebook->api('/'.$post['to']['data'][0]['id']);
					if( isset( $fb_target_user['link'])) {
						$post['to']['data'][0]['link_to'] = $fb_target_user['link'];
					}
				} catch (FacebookApiException $e) {}
			}

		} // foreach

		return $stream['home'];
	}// get initial stream

	private function getScrolledStream($paging) {

		$stream = json_decode($paging);
		$stream = $this->facebook->api($paging);

		foreach( $stream['data'] as $key => &$post ) {

			if( isset($post['object_id']) ) {

				try {
					$new_media = $this->facebook->api('/'.$post['object_id']);
					if( isset($new_media['images']) ) {
						$post['picture'] = $new_media['images'][1]['source'];
					} else if( isset( $new_media['format'])) {
						$post['video']['iframe'] = $new_media['format'][1]['embed_html'];
						$post['video']['picture'] = $new_media['format'][1]['picture'];
					}
				} catch (FacebookApiException $e) {}

			}
			if( isset($post['from']) ) {

				try {
					$fb_user = $this->facebook->api('/'.$post['from']['id']);
					if( isset( $fb_user['link'])) {
						$post['from']['link_to'] = $fb_user['link'];
					}
				} catch (FacebookApiException $e) {}

			}
			if( isset($post['to']) ) {

				try {
					$fb_target_user = $this->facebook->api('/'.$post['to']['data'][0]['id']);
					if( isset( $fb_target_user['link'])) {
						$post['to']['data'][0]['link_to'] = $fb_target_user['link'];
					}
				} catch (FacebookApiException $e) {}
			}

		} // foreach

		return $stream;

	}// get scrolled stream

}
