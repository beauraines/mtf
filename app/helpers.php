<?php

//namespace something;

function twitterFeed()
{
$connection = new TwitterOAuth(Auth::user()->consumer_key, Auth::user()->consumer_secret, Auth::user()->access_token, Auth::user()->access_secret_token);
//$connection = new TwitterOAuth(Config::get('twitter.consumer_key'), Config::get('twitter.consumer_secret'), Config::get('twitter.access_token'), Config::get('twitter.access_secret_token'));
//$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".Config::get('twitter.twitter_user')."&count=5");
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".Auth::user()->twitter_user."&count=5");
return $tweets;
}

function verifyCredentials()
{
$connection = new TwitterOAuth(Auth::user()->consumer_key, Auth::user()->consumer_secret, Auth::user()->access_token, Auth::user()->access_secret_token);
$tweets = $connection->get("account/verify_credentials");
return json_encode($tweets);
}

