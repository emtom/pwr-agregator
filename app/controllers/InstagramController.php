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

	public function getStream() {

        $user = Instagram::getCurrentUser();
        $data = $user->getFeed()->getData();

        $stream = [];

        foreach( $data as $item ) {

            $newItem = new stdClass();

            $newItem->username = $item->getUser()->getUserName();
            $newItem->type = '';
            $newItem->like_count = $item->getLikesCount();
            $newItem->img_url = $item->getLowRes();

            if($item->getCaption())
                $newItem->caption = $item->getCaption()->getText();

            $newItem->item_type = 'insta';

            array_push($stream, $newItem);
        }

        //print_r( $stream );
        return $stream;
    }

    public function getFriendList() {

        $currentUser = Instagram::getCurrentUser();
        $friendList = $currentUser->getFollowers();

        return $friendList;
    }


}
