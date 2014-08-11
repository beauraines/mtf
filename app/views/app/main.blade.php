@extends('layouts.default')
@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-9">
				{{ link_to_route('users.update','Display account info', [ Auth::user()->id ]); }}
		<p>
		{{ link_to_route('users.edit','Edit account info', [ Auth::user()->id ]); }}
		<p>
		{{ link_to_action('UsersController@index','Users'); }}
		<p>
		<div>
		<h2>Step 1</h2>
			{{ Form::open(['route' => 'follow.store',  'files' => true]) }}
				<div class='form-group'>
				{{ Form::label('followfile','Upload a file of Twitter User to follow  ') }}
				{{ Form::file('followfile',['class'=>'form-control']) }}
				{{ Form::submit('Upload file',['class'=>'btn btn-primary']) }}
				{{ $errors->first('followfile','<span class=error>:message</span>') }}
				</div>
			{{ Form::close() }}
		<p>
		<h2>Step 2</h2>
			<div class='form=group'>
			{{ link_to('/followfromfollow','Process Follows',['class'=>'btn btn-primary']) }}
			<span class="help-block">This will follow up to 1000 Twitter users from your uploaded list or until you are rate limited for following 1000 users.</span>
			</div>
		</div>
		{{ link_to_action('FollowController@index','Display Follows'); }}
		<p>

		<p>
		{{ link_to('/tweets','Your Tweets'); }}
	</div>

	<div class="col-sm-3">
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

</div>
</div>




@stop
