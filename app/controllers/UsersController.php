<?php

use Illuminate\Support\MessageBag;


class UsersController extends \BaseController {

        protected $user;

        public function __construct(User $user)
        {
          $this->user = $user;
        }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return 'Shows all users. If it were written.';
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();


                if ( ! $this->user->fill($input)->isValid() )
                 {
		   //return $this->user->errors;
                   return Redirect::back()->withInput()->withErrors($this->user->errors);
                 }

                $this->user->password = Hash::make($this->user->password);
		$this->user->__unset('password_confirmation');
		$this->user->save();

          if (Auth::attempt(Input::only('email','password')))
          {
             return Redirect::intended('/u');
          }
          return Redirect::back()->withInput();



	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//return 'Show user ' . $id . ' info.';
		$user = Auth::user();
		return $user;
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = Auth::user();
		return View::make('user.update')->withUser($user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	
		$input = Input::all();
		//$errors = new MessageBag; // initiate MessageBag

		$this->user = Auth::user();
		//$this->user =  User::find($id);;
/*
	    // Check for matching passwords
		if( $input['password'] != $input['password_confirmation'] ) {

		   $errors = new MessageBag(['password' => ['Passwords do not match.']]);
                   return Redirect::back()->withInput(Input::except(['password','password2']))
				->withErrors($errors);
		}
*/
                if ( ! $this->user->fill($input)->isUpdateValid() )
                 {
                   //return $this->user->errors;
                   return Redirect::back()->withInput()->withErrors($this->user->errors);
                 }

		
		$this->user->password = Hash::make($input['password']);
		$this->user->__unset('password_confirmation');
		$this->user->save();
		//return $this->user;

		return Redirect::to('/u');
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
