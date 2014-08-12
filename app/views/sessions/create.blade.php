@extends('layouts.default')
@section('content')
 <div class="welcome" style='background-color: aliceblue;'>
 {{ Form::open(['route'=>'sessions.store']) }}
  <div class='form-group'>
   {{ Form::label('email','Email address:') }}
   {{ Form::email('email',null,['class'=>'form-control']) }}
 <div>
   {{ Form::label('password','Password:') }}
   {{ Form::password('password',['class'=>'form-control']) }}
   {{ $errors->first('errors','<span class=text-danger>:message</span>') }}
 </div>
 <div>
   {{ Form::submit('Login',['class'=>'btn btn-primary']) }}
 </div>
 <div>
 {{ Form:: close() }}
  </div>
 </div>
<div style="text-align:right;">
{{ link_to_route('users.create','Create a new account');}}
</div>
</div>
@stop
