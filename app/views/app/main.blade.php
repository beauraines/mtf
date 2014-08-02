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
{{ link_to('/logout','Logout'); }}

<!--
<p>
{{ Form::open(array('route' => array('users.destroy', Auth::user()->id), 'method' => 'delete')) }}
    <button type="submit" >Delete Account</button>
{{ Form::close() }}

-->




@stop
