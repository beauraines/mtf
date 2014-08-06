<?php

use Illuminate\Support\MessageBag;

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

                   $errors = new MessageBag(['followfile' => ['No file supplied.']]);
                   return Redirect::back()
                                ->withErrors($errors);
		}

		// Process file

		$file = Input::file('followfile');

		$toa = new TwitterOAuth(Auth::user()->consumer_key,
					Auth::user()->consumer_secret,
					Auth::user()->access_token,
					Auth::user()->access_token_secret);

		$friends = $toa->get('friends/ids', array('cursor' => -1));

		$follows = $this->follow->followFromFile($file, $friends, $toa);
		//$follows = $this->follow->addFromFile($file);

		return $follows;


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
