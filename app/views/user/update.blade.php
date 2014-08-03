@extends('layouts.default')
@section('content')

	<h1>Revise user info</h1>

	{{ Form::open(['route' => ['users.update',$user->id], 'method'=>'PUT',  'files' => true]) }}
		<div>
		{{ Form::label('name','Username: ') }}
		{{ Form::text('name',$user->name) }}
		{{ $errors->first('name','<span class=error>:message</span>') }}
		</div>

		<div>
		{{ Form::label('twitter_user','Twitter username: ') }}
		{{ Form::text('twitter_user',$user->twitter_user) }}
		{{ $errors->first('twitter_user','<span class=error>:message</span>') }}
		</div>

		<div>
		{{ Form::label('email','Email Address: ') }}
		{{ Form::label('email',$user->email) }}
		{{ $errors->first('email','<span class=error>:message</span>') }}
		</div>

		<div>
		{{ Form::label('password','Password: ') }}
		{{ Form::password('password') }}

		{{ Form::label('password_confirmation','Repeat Password: ') }}
		{{ Form::password('password_confirmation') }}

		{{ $errors->first('password') }}
		</div>

                <div>

                The following keys can be obtained from {{ link_to('dev.twitter.com') }}. You will not be able to use the application until they have been entered. </br>

                {{ Form::label('consumer_key','Consumer Key: ') }}
                {{ Form::text('consumer_key',$user->consumer_key) }}
                {{ Form::label('consumer_secret','Consumer Secret: ') }}
                {{ Form::text('consumer_secret',$user->consumer_secret) }}

                <p>

                {{ Form::label('access_token','Access Token: ') }}
                {{ Form::text('access_token',$user->access_token) }}
                {{ Form::label('access_token_secret','Access Token Secret: ') }}
                {{ Form::text('access_token_secret',$user->access_token_secret) }}
                </div>


		<div>
		{{ Form::submit('Update User') }}
		</div>
	{{ Form::close() }}


@stop
