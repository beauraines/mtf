@extends('layouts.default')
@section('content')

	<h1>Revise user info</h1>
<div class="col-xs-8" >
	{{ Form::open(['route' => ['users.update',$user->id], 'method'=>'PUT',  'files' => true]) }}
		<div class="form-group">
		{{ Form::label('name','Username: ') }}
		{{ Form::text('name',$user->name,['class'=>'form-control']) }}
		{{ $errors->first('name','<span class=text-danger>:message</span>') }}
		</div>

		<div class="form-group">
		{{ Form::label('twitter_user','Twitter username: ') }}
		{{ Form::text('twitter_user',$user->twitter_user,['size'=>20,'class'=>'form-control']) }}
		{{ $errors->first('twitter_user','<span class=text-danger>:message</span>') }}
		</div>

		<div class="form-group">
		{{ Form::label('email','Email Address: ') }}
		{{ Form::text('email',$user->email,['class'=>'form-control','disabled'=>'disabled']) }}
		{{ $errors->first('email','<span class=text-danger>:message</span>') }}
		</div>

		<div class="form-group">
		{{ Form::label('password','Password: ') }}
		{{ Form::password('password',['class'=>'form-control']) }}

		{{ Form::label('password_confirmation','Repeat Password: ') }}
		{{ Form::password('password_confirmation',['class'=>'form-control']) }}

		{{ $errors->first('password') }}
		</div>

                <div class="form-group">

    		<span class="help-block">The following keys can be obtained from {{ link_to('http://dev.twitter.com') }}. You will not be able to use the application until they have been entered. </span>

                {{ Form::label('consumer_key','Consumer Key: ') }}
                {{ Form::text('consumer_key',$user->consumer_key,['class'=>'form-control','size'=>52]) }}
                {{ Form::label('consumer_secret','Consumer Secret: ') }}
                {{ Form::text('consumer_secret',$user->consumer_secret,['class'=>'form-control','size'=>52]) }}

                <p>

                {{ Form::label('access_token','Access Token: ') }}
                {{ Form::text('access_token',$user->access_token,['class'=>'form-control','size'=>52]) }}
                {{ Form::label('access_token_secret','Access Token Secret: ') }}
                {{ Form::text('access_token_secret',$user->access_token_secret,['class'=>'form-control','size'=>52]) }}
                </div>


		<div class="form-group">
		{{ Form::submit('Update User',['class'=>'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>

@stop
