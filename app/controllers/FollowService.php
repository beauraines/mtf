<?php 

class FollowService {

    public function fire($job, $data)
    {

    		Auth::loginUsingId($data['user_id']);
                
		$toa = new TwitterOAuth(Auth::user()->consumer_key,
                                        Auth::user()->consumer_secret,
                                        Auth::user()->access_token,
                                        Auth::user()->access_token_secret);

                $friends = $toa->get('friends/ids', array('cursor' => -1));
		

                $follows = new Follow;
                $follows = $follows->followFromFollow(NULL, $friends, $toa);
		
		$user = User::find(Auth::user()->id);

		$name = $user->name;
		$email = $user->email;
		$twitter_user = $user->twitter_user;
		$data = ['name' => $user->name, 'email' => $user->email, 'twitter_user' => $user->twitter_user, $follows => $follows];
		$subject = 'Job ' . $job . ' complete for ' .$name;
		
		Mail::queue('emails.jobcomplete', $data, function($message) use ($name, $email, $twitter_user, $follows)
		{
    		  $message->to('beau.raines@gmail.com', 'Beau Raines')->subject($subject);
		});

		$job->delete();



    }

}
