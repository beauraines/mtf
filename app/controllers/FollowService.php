<?php 

class FollowService {

    public function fire($job, $data)
    {
                
		$toa = new TwitterOAuth(Auth::user()->consumer_key,
                                        Auth::user()->consumer_secret,
                                        Auth::user()->access_token,
                                        Auth::user()->access_token_secret);

                $friends = $toa->get('friends/ids', array('cursor' => -1));
		

                $follows = new Follow;
                $follows = $follows->followFromFollow(NULL, $friends, $toa);

    }

}
