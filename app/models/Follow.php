<?php


class Follow extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'follows';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id');
	public $timestamps = true;

	protected $fillable =array('twitter_id','screenname',
				  'follow_date','unfollow_date',
				  'filename','user_id','status_message',
				  'status_code');

 	public static function status($user_id, $processed = 0, $filename = NULL) {
		
		// Return how many followed successfully or with errors
		  
		  if ( ! isset($filename) ) {

			$successful_follow = Follow::where('user_id',$user_id)
					->where('status_code',1)  // Successful follow
					->count();
	
			$already_follow = Follow::where('user_id',$user_id)
					->where('status_code',0)  
					->count();

			$requested_to_follow = Follow::where('user_id',$user_id)
					->where('status_code',160)  
					->count();

			$still_to_follow = Follow::where('user_id',$user_id)
					->whereNull('status_code')  
					->count();

			$errored = Follow::where('user_id',$user_id)
					->where('status_code','>',1)  
					->where('status_code','<>',160)  
					->count();

		   }

		   if ( isset($filename) ) {


			$successful_follow = Follow::where('user_id',$user_id)
					->where('status_code',1)  // Successful follow
					->where('filename',$filename)
					->count();
	
			$already_follow = Follow::where('user_id',$user_id)
					->where('status_code',0)  
					->where('filename',$filename)
					->count();

			$requested_to_follow = Follow::where('user_id',$user_id)
					->where('status_code',160)  
					->where('filename',$filename)
					->count();

			$still_to_follow = Follow::where('user_id',$user_id)
					->whereNull('status_code')  
					->where('filename',$filename)
					->count();

			$errored = Follow::where('user_id',$user_id)
					->where('status_code','>',1)  
					->where('filename',$filename)
					->where('status_code','<>',160)  
					->count();

			}

		    if ( isset($file) ) {
			return ['successful_follow' => $successful_follow,
				'already_follow' => $already_follow,
				'requested_to_follow' => $requested_to_follow,
				'still_to_follow' => $still_to_follow,
				'errored' => $errored,
				'file' => $file,
				'processed' => $processed,
			       ];
	 	   }
		    if ( ! isset($file) ) {
			return ['successful_follow' => $successful_follow,
				'already_follow' => $already_follow,
				'requested_to_follow' => $requested_to_follow,
				'still_to_follow' => $still_to_follow,
				'errored' => $errored,
				'processed' => $processed,
			       ];
	 	   }
	}

	public function followFromFollow($limits, $friends, $toa) {
		// Find the follows based upon the array $limits

			$to_follow = Follow::where('user_id',Auth::user()->id)
					->where('status_code','<>',1)  // Successful follow
					->where('status_code','<>',0)  // Already follow
					->where('status_code','<>',160) // Already requested to follow
					->where('status_code','<>',162) // Blocked from following this user
					->where('status_code','<>',108) // User not found
					->where('status_code','<>',162) // Blocked from following this user 
					->orWhere('status_code',NULL) // Not followed yet
					->take(1000) // only get 1000 at a time
					->get();

			//return $to_follow;


		// Foreach in that collection, do the follow logic
		// maybe this should be moved to the helper file?

			$processed = 0;
			$followed = 0;
			$errored = 0;

		foreach ($to_follow as $follow) {

			/*
			$follow = new Follow;
			$follow->fill(['twitter_id' => $to_follow['id'],
					    'screenname' => $to_follow['screenname'],
					    'filename' => $file->getClientOriginalName(),
					    'user_id' => Auth::user()->id,
					    ]);
			$follow->save();
			*/

			$processed = $processed + 1;

			if ( in_array($follow->twitter_id, $friends->ids))  {
					$dt = new DateTime();
					$follow->fill(['status_message' => 'You already follow ' . $follow['screenname'],
						      'status_code' => 0 ,
						      //'follow_date' => $dt->format('Y-m-d H:i:s'),
						      ]);
					$follow->save();
			}

			if (empty($friends->ids) or ! in_array($follow->twitter_id, $friends->ids))  {
			//if ( TRUE )  { // For testing purposes

				$interval = rand(1,5);
				//$interval = 3;
				sleep($interval);

				//$ret = $toa->post('friendships/create', array('user_id' => $follow->twitter_id));
				$ret = $toa->post('friendships/create', array('screen_name' => $follow->screenname));

				//var_dump($ret);

				if (  empty($ret->errors) ) {
					$dt = new DateTime();
					$follow->fill(['status_message' => 'Followed okay',
						      'follow_date' => $dt->format('Y-m-d H:i:s'),
						      'status_code' => 1 ,
						      ]);
					$follow->save();
					$followed = $followed + 1;
				}

				if ( ! empty($ret->errors) ) { // How am I supposed to know this was an array of objects?

					 $dt = new DateTime();

					$follow->fill(['status_message' => $ret->errors[0]->message,
						      'status_code' =>  $ret->errors[0]->code,
							// Is there a better wan I can process this?
						      'follow_date' => $dt->format('Y-m-d H:i:s'),
						      ]);
					$follow->save();
					$errored = $errored + 1 ;

					//break out if error code 161 
					if ($ret->errors[0]->code == 161 ) { goto end; }
				}

			}
		}
		// Return

		end:

			$follow = new Follow;
                return array( 'job_status'=>['processed' => $processed,
                              		     'followed' => $followed,
                              		     'errored' => $errored,
					    ],
			      'overall_status' => $follow->status(Auth::user()->id),
                            );

	}

	public function followFromFile($file, $friends, $toa) {

		$to_follow = Excel::load($file, function($reader) {} )->toArray();

		// Process the array
		  // Final GOAL: Load into DB table, start job to follow from table
		  // Near term goal: Follow ids from the array

			$processed = 0;
			$followed = 0;
			$errored = 0;

		foreach ($to_follow as $to_follow) {

			$follow = new Follow;
			$follow->fill(['twitter_id' => $to_follow['id'],
					    'screenname' => $to_follow['screenname'],
					    'filename' => $file->getClientOriginalName(),
					    'user_id' => Auth::user()->id,
					    ]);
			$follow->save();

			$processed = $processed + 1;

			if ( in_array($follow->twitter_id, $friends->ids))  {
					$dt = new DateTime();
					$follow->fill(['status_message' => 'You already follow ' . $to_follow['screenname'],
						      'status_code' => 0 ,
						      //'follow_date' => $dt->format('Y-m-d H:i:s'),
						      ]);
					$follow->save();
			}

			if (empty($friends->ids) or ! in_array($follow->twitter_id, $friends->ids))  {
			//if ( TRUE )  { // For testing purposes

				$interval = rand(1,5);
				//$interval = 3;
				sleep($interval);

				//$ret = $toa->post('friendships/create', array('user_id' => $follow->twitter_id));
				$ret = $toa->post('friendships/create', array('screen_name' => $follow->screenname));

				//var_dump($ret);

				if (  empty($ret->errors) ) {
					$dt = new DateTime();
					$follow->fill(['status_message' => 'Followed okay',
						      'follow_date' => $dt->format('Y-m-d H:i:s'),
						      'status_code' => 1 ,
						      ]);
					$follow->save();
					$followed = $followed + 1;
				}

				if ( ! empty($ret->errors) ) { // How am I supposed to know this was an array of objects?

					 $dt = new DateTime();

					$follow->fill(['status_message' => $ret->errors[0]->message,
						      'status_code' =>  $ret->errors[0]->code,
							// Is there a better wan I can process this?
						      'follow_date' => $dt->format('Y-m-d H:i:s'),
						      ]);
					$follow->save();
					$errored = $errored + 1 ;
				}

			}
	 	 }

		return array( 'processed' => $processed,
			      'followed' => $followed,
			      'errored' => $errored,
			    );

	}


	public function addFromFile($file) {

		$to_follow = Excel::load($file, function($reader) {} )->toArray();

			$added = 0;

		foreach ($to_follow as $to_follow) {

			$follow = new Follow;
			$follow->fill(['twitter_id' => $to_follow['id'],
					    'screenname' => $to_follow['screenname'],
					    'filename' => $file->getClientOriginalName(),
					    'user_id' => Auth::user()->id,
					    ]);
			$follow->save();
			$added++; 

		}
		
		return array('added' => $added);
	}



}
