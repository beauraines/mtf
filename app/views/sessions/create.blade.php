@extends('layouts.default')
@section('content')
 <div>
 {{ Form::open(['route'=>'sessions.store']) }}
   {{ Form::label('email','Email address:') }}
   {{ Form::email('email') }}
   {{ $errors->first('email','<span class=error>:message</span>') }}
 </div>
 <div>
   {{ Form::label('password','Password:') }}
   {{ Form::password('password') }}
   {{ $errors->first('password','<span class=error>:message</span>') }}
 </div>
 <div>
   {{ Form::submit('Login') }}
 </div>
 {{ Form:: close() }}

<div>
{{ link_to_route('users.create','Create a new account');}}
</div>
@stop
