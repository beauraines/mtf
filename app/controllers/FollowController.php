<?php

class FollowController extends \BaseController {

        protected $follow;

        public function __construct(Follow $follow)
        {
          $this->follow = $follow;
        }

	public function getData() 
	{
		//
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$follows= Follow::where('user_id',Auth::user()->id)->get();
		//$follows= Follow::all();
		return View::make('follow.index', [ 'follows'=>$follows]);
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Check that file was provided

		if ( ! Input::hasFile('followfile') )  {

		//Error message no file supplied.

		}

		// Read file into array

		$file = Input::file('followfile');

		$to_follow = Excel::load($file, function($reader) {} )->toArray();


		// Process the array
		  // Final GOAL: Load into DB table, start job to follow from table
		  // Near term goal: Follow ids from the array

		$list = array();

		$toa = new TwitterOAuth(Auth::user()->consumer_key,
					Auth::user()->consumer_secret,
					Auth::user()->access_token,
					Auth::user()->access_token_secret);

		$friends = $toa->get('friends/ids', array('cursor' => -1));

		//var_dump($friends);
		//var_dump($toa);

			$processed = 0;
			$followed = 0;
			$errored = 0;

		foreach ($to_follow as $to_follow) {

			//$list = array_add($list,$to_follow['id'],$to_follow['screenname']);
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

				//$interval = rand(10,99) + 10;
				$interval = 3;
				sleep($interval);

				$ret = $toa->post('friendships/create', array('user_id' => $follow->twitter_id));

				//$list = array_add($list,$follow->twitter_id,$ret);
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

				if ( ! empty($ret->errors) ) {

					 $dt = new DateTime();

					$follow->fill(['status_message' => json_encode($ret->errors),
						      'status_code' =>  $ret->errors->code,
						      'follow_date' => $dt->format('Y-m-d H:i:s'),
						      ]);
					$follow->save();
					$errored = $errored + 1 ;
				}

			}
	 	 }

		//return $list;
		//return $to_follow['1']['id'];
		//return Follow::all();
		return array( 'processed' => $processed,
			      'followed' => $followed,
			      'errored' => $errored,
			    );
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
