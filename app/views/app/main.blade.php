@extends('layouts.default')
@section('content')

<div style="float:left;">

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
                {{ $errors->first('followfile','<span class=error>:message</span>') }}
                </div>
        {{ Form::close() }}

<p>
{{ link_to_action('FollowController@index','Follows'); }}
<p>
{{ link_to('/followfromfollow','Follow another 1000 from to Follow'); }}

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

</div>

<div style="width:200px;float:right;">
<h2>Follow status</h2>
<table id="status" class="table">
<thead>
<tr>
	<td>Category</td>
	<td>Count</td>
</tr>
</thead>
@foreach ( $status as $status=>$value )
<tr>
	<td>{{ $status }}</td>
	<td> {{$value}} </td>
</tr>
@endforeach
</table>
</div>






<!--
<p>
{{ Form::open(array('route' => array('users.destroy', Auth::user()->id), 'method' => 'delete')) }}
    <button type="submit" >Delete Account</button>
{{ Form::close() }}

-->


@stop
