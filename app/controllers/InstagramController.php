<?php

class InstagramController extends \BaseController {

	public function connect() {

		if (Session::has(Config::get('instagram::session_name')))
            Session::forget(Config::get('instagram::session_name'));

        Instagram::authorize();
	}

	public function authorize() {

		Session::put(Config::get('instagram::session_name'), Instagram::getAccessToken(Input::get('code')));

        return Redirect::to('/');
    }

    public function disconnect() {

        Session::forget(Config::get('instagram::session_name'));

        return Redirect::to('/');
    }

	public function getInitialStream() {}


}
