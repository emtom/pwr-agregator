<?php

class TwitterController extends \BaseController {


	public function getFriendList() {

		$friendList = json_decode( Twitter::getFriends( array('format' => 'json') ), true);
		$friendList = $friendList['users'];

		// echo "<pre>";
		// dd($friendList);
		foreach($friendList as $key => &$friend) {
			$friend['type'] = 'tw';
		}

		return $friendList;
	}


}

