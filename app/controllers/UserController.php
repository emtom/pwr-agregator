<?php

class UserController extends \BaseController {

	public function profile() {

		if(Auth::check()) {
			$user = Auth::user();

			$fbFriendList = App::make('FacebookController')->getFriendList();
			$twitterFriendList = App::make('TwitterController')->getFriendList();

			return View::make('user.profile')
				->with('user', $user)
				->with('fbFriends', $fbFriendList)
				->with('twitterFriends', $twitterFriendList);

		}

	}

	public function logout() {

		if(Auth::check()) {
			Auth::logout();
			return Redirect::to('/');
		} else {
			return Redirect::to('/home');
		}


	}

	public function getLogin() {
        if (Session::has(Config::get('instagram::session_name')))
            Session::forget(Config::get('instagram::session_name'));

        Instagram::authorize();
    }

    public function getAuthorize() {
        Session::put(Config::get('instagram::session_name'), Instagram::getAccessToken(Input::get('code')));

        return Redirect::to('/');
    }

    public function getLogout() {
        Session::forget(Config::get('instagram::session_name'));

        return Redirect::to('/');
    }

}
