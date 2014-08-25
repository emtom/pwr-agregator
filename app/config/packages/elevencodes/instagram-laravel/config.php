<?php

return array(
    /*
	|--------------------------------------------------------------------------
	| Client ID
	|--------------------------------------------------------------------------
	|
	| Your Instagram client_id.
	|
	*/
	'client_id' 	=> 	'aa461340ca1e4b53974a0841db951407',

	/*
	|--------------------------------------------------------------------------
	| Client Secret
	|--------------------------------------------------------------------------
	|
	| Your Instagram client_secret.
	|
	*/
	'client_secret'	=>	'8c43a6ecc0c446afb6015abac04ebee7',

	/*
	|--------------------------------------------------------------------------
	| Redirect URI
	|--------------------------------------------------------------------------
	|
	| The redirect_uri you used in the authorization request.
	| Note: this has to be the same value as in the authorization request.
	|
	*/
	'redirect_uri'	=>	'http://localhost/agregator/public/',

	/*
	|--------------------------------------------------------------------------
	| Scope
	|--------------------------------------------------------------------------
	|
	| Allows you to specify the scope of the access you’re requesting from the user.
	| Currently, all apps have basic read access by default.
	|
	| Here are the scopes we currently support:
	|	* basic - to read any and all data related to a user (granted by default)
	|	* comments - to create or delete comments on a user’s behalf
	|	* relationships - to follow and unfollow users on a user’s behalf
	|	* likes - to like and unlike items on a user’s behalf
	|
	*/
	'scope'			=> array('basic'),

	/*
	|--------------------------------------------------------------------------
	| Session name
	|--------------------------------------------------------------------------
	|
	| Referencing session key to store access token.
	|
	*/
	'session_name' 	=> 'instagram_access_token'
);