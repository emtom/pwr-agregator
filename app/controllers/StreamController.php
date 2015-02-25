<?php

class StreamController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getStream() {

		$getType = Input::get('getType');
		$paging = Input::get('paging');

		if($getType == NULL) {
			$getType = 'initial';
		}

		$fbstream = App::make('FacebookController')->getStream($getType, $paging);
		$twstream = App::make('TwitterController')->getStream();
		$instastream = App::make('InstagramController')->getStream();

		//dd($instagramstream);

		$stream['data'] = [];
		$stream['paging']['fb'] = $fbstream['paging'];

		foreach( $fbstream['data'] as $fbitem) {
			array_push($stream['data'], $fbitem);
		}
		foreach( $twstream as $twitem) {
			array_push($stream['data'], $twitem);
		}
		foreach( $instastream as $instaitem) {
			array_push($stream['data'], $instaitem);
		}

		shuffle($stream['data']);

		return $stream;
	}

}
