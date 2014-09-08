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

		$stream = App::make('FacebookController')->getStream($getType, $paging);


		//print_r($stream);

		return $stream;
	}

}
