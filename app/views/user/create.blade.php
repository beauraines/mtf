@extends('layouts.default')
@section('content')

	<h1>Sign Up New User</h1>

	{{ Form::open(['route' => 'users.store']) }}
		<div>
		{{ Form::label('name','Username: ') }}
		{{ Form::text('name','First name') }}

		{{ $errors->first('name','<span class=error>:message</span>') }}

		</div>

		<div>
		{{ Form::label('email','Email Address: ') }}
		{{ Form::email('email','somebody@somecompany.com') }}
		{{ $errors->first('email','<span class=error>:message</span>') }}
		</div>

		<div>
		{{ Form::label('password','Password: ') }}
		{{ Form::password('password') }}
		{{ $errors->first('password') }}
		</div>
		<div>
		{{ Form::label('password_confirmation','Password Confirmation: ') }}
		{{ Form::password('password_confirmation') }}
		</div>

		<div>

		The following keys can be obtained from {{ link_to('dev.twitter.com') }}.  You can sign up with out these and update them later, but you will not be able to use the application until they have been entered. </br>
		
		{{ Form::label('consumer_key','Consumer Key: ') }}
		{{ Form::text('consumer_key') }}
		{{ Form::label('consumer_secret','Consumer Secret: ') }}
		{{ Form::text('consumer_secret') }}

		<p>

		{{ Form::label('access_token','Access Token: ') }}
		{{ Form::text('access_token') }}
		{{ Form::label('access_token_secret','Access Token Secret: ') }}
		{{ Form::text('access_token_secret') }}
		</div>


		<div>
		{{ Form::submit('Sign up') }}
		</div>
	{{ Form::close() }}

<div>
{{ link_to_route('sessions.create','Existing users login here');}}
</div>
@stop
