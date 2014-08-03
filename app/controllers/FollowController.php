<?php

class FollowController extends \BaseController {

        protected $follow;

        public function __construct(Follow $follow)
        {
          $this->follow = $follow;
        }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Follow::all();
		
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

		//$list = array();

		foreach ($to_follow as $to_follow) {

			//$list = array_add($list,$to_follow['id'],$to_follow['screenname']);
			$follow = new Follow;
			$follow->fill(['twitter_id' => $to_follow['id'],
					    'screenname' => $to_follow['screenname'],
					    'filename' => $file->getClientOriginalName(),
					    'user_id' => Auth::user()->id,
					    ]);
			$follow->save();

		}

		//return $list;
		//return $to_follow['1']['id'];
		return Follow::all();
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
