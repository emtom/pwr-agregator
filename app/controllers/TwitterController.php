<?php

class TwitterController extends \BaseController {


	public function getFriendList() {

		/* original data, call temp removed becouse of Twitter limitations */
		$friendList = json_decode( file_get_contents('http://maffish.linuxpl.info/agregator/twitterFriends.json'), true);
		$friendList = $friendList['users'];

		foreach($friendList as $key => &$friend) {
			$friend['type'] = 'tw';
		}

		return $friendList;
	}

	public function getStream() {

		/* original data, call temp removed becouse of Twitter limitations */
		//$stream = json_decode(Twitter::getHomeTimeline(array('count' => 20, 'format' => 'json')), true);
		$stream = json_decode( file_get_contents('http://maffish.linuxpl.info/agregator/twitterdata.json'), true);

		//$obj = new stdClass();


		return $stream;
	}


}

