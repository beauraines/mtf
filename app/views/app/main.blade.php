@extends('layouts.default')
@section('content')

 {{ 'Welcome ' . Auth::user()->name; }}

<p>
{{ link_to_route('users.update','Display account info', [ Auth::user()->id ]); }}
<p>
{{ link_to_route('users.edit','Edit account info', [ Auth::user()->id ]); }}
<p>
{{ link_to_action('UsersController@index','Users'); }}
<p>

        {{ Form::open(['route' => 'follow.store',  'files' => true]) }}

                <div>
                {{ Form::label('followfile','Upload a file of Twitter User to follow  ') }}
                {{ Form::file('followfile') }}
                {{ Form::submit('Upload file') }}
                </div>
        {{ Form::close() }}

<p>
{{ link_to_action('FollowController@index','Follows'); }}

<p>
<!--
        {{ Form::open(['route' => 'follow.store',  'files' => true]) }}
                <div>
                {{ Form::label('followfile','Upload a file of Twitter User to follow  ') }}
                {{ Form::file('followfile') }}
                {{ Form::submit('Upload file') }}
                </div>
        {{ Form::close() }}
-->

<p>
{{ link_to('/tweets','Your Tweets'); }}


<p>
{{ link_to('/logout','Logout'); }}

<!--
<p>
{{ Form::open(array('route' => array('users.destroy', Auth::user()->id), 'method' => 'delete')) }}
    <button type="submit" >Delete Account</button>
{{ Form::close() }}

-->




@stop
