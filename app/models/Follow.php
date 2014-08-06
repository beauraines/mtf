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

				$ret = $toa->post('friendships/create', array('user_id' => $follow->twitter_id));

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
