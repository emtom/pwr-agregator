<?php

class UserController extends \BaseController {

	public function profile() {

		if(Auth::check()) {
			$user = Auth::user();
			$profiles = $user->profiles();

			$fbFriendList = App::make('FacebookController')->getFriendList();
			$twitterFriendList = App::make('TwitterController')->getFriendList();
			//$instagramFriendList = App::make('InstagramController')->getFriendList();

			return View::make('user.profile')
				->with('user', $user)
				->with('fbFriends', $fbFriendList)
				->with('twitterFriends', $twitterFriendList)
				//->with('instagramFriends', $instagramFriendList)
				->with('profiles', $profiles);

		} else {
			return Redirect::to('/');
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



}
