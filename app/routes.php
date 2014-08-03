<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('u', function()
{
	return View::make('app.main');
});

Route::get('login','SessionsController@create');
Route::get('logout','SessionsController@destroy');

Route::resource('follow','FollowController');
Route::resource('users','UsersController');
Route::resource('sessions','SessionsController');


Route::get('/tweets', function() {
	//return Config::get('twitter.consumer_key');

//$connection = new \TwitterOAuth(Config::get('twitter.consumer_key'), Config::get('twitter.consumer_secret'), Config::get('twitter.access_token'), Config::get('twitter.access_secret_token'));
//$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".Config::get('twitter.twitter_user')."&count=5");
//return json_encode($tweets);
$tweets = twitterFeed();
return $tweets;

	//return "Twitter consumer key";
})->before('auth');


Route::get('/whoami', function()
{
        return Auth::user();
})->before('auth')
;


Route::get('/verifyCredentials', function() {
$tweets = verifyCredentials();
return $tweets;
})->before('auth');

