@extends('layouts.default')
@section('content')
 <div class="welcome">
 {{ Form::open(['route'=>'sessions.store']) }}
   {{ Form::label('email','Email address:') }}
   {{ Form::email('email') }}
   {{ $errors->first('email','<span class=error>:message</span>') }}
 <div>
   {{ Form::label('password','Password:') }}
   {{ Form::password('password') }}
   {{ $errors->first('password','<span class=error>:message</span>') }}
 </div>
 <div>
   {{ Form::submit('Login') }}
 </div>
 <div>
 {{ Form:: close() }}
 </div>
<div style="text-align:right;">
{{ link_to_route('users.create','Create a new account');}}
</div>
</div>
@stop
