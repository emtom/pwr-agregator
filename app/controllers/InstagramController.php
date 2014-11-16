<?php

class InstagramController extends \BaseController {

	public function connect() {

		if (Session::has(Config::get('instagram::session_name')))
            Session::forget(Config::get('instagram::session_name'));

        Instagram::authorize();
	}

	public function authorize() {

		Session::put(Config::get('instagram::session_name'), Instagram::getAccessToken(Input::get('code')));

        return Redirect::to('profile');
    }

    public function disconnect() {

        Session::forget(Config::get('instagram::session_name'));

        return Redirect::to('profile');
    }

	public function getInitialStream() {}

    public function getFriendList() {

        $currentUser = Instagram::getCurrentUser();
        $friendList = $currentUser->getFollowers();

        return $friendList;
    }


}
