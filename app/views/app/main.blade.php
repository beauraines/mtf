@extends('layouts.default')
@section('content')
<div class="container">


@if ( isset($job_id) ) 
<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Processing uploaded list. Job {{$job_id}} successfully started.</div> 
@endif


@if ( ! $tokens_set ) 
<div class="alert alert-danger" role="alert">Twitter Access Tokens have not been set. Please update your  {{ link_to_route('users.edit','settings', [ Auth::user()->id ],["class"=>"alert-link"]); }}.</div> 
@endif

<div class="row">
	<div class="col-sm-9">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li><a href="#Settings" role="tab" data-toggle="tab">Settings</a></li>
  <li><a href="#Admin" role="tab" data-toggle="tab">Admin</a></li>
  <li class="active"><a href="#Follows" role="tab" data-toggle="tab">Follows</a></li>
  <li><a href="#Tweets" role="tab" data-toggle="tab">Tweets</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane" id="Settings">

				{{ link_to_route('users.update','Display account info', [ Auth::user()->id ]); }}
		<p>
		{{ link_to_route('users.edit','Edit account info', [ Auth::user()->id ]); }}
  </div>
  <div class="tab-pane" id="Admin">
		{{ link_to_action('UsersController@index','Display Users'); }}
  </div>
  <div class="tab-pane active" id="Follows">
		<div>
		<h2>Upload a new file</h2>
                        <span class="help-block">Uploading a new file will automatically kick off a job to start processing up to 1000 users, the daily maximum.</span>

			{{ Form::open(['route' => 'follow.store',  'files' => true]) }}
				<div class='form-group'>
				{{ Form::label('followfile','Upload a file of Twitter User to follow  ') }}
				{{ Form::file('followfile',['class'=>'form-control']) }}
				{{ Form::submit('Upload file',['class'=>'btn btn-primary']) }}
				{{ $errors->first('followfile','<span class=text-danger>:message</span>') }}
				</div>
			{{ Form::close() }}
		<p>
		<h2>Process Follows</h2>
			<div class='form=group'>
			{{ link_to('/followfromfollow','Process Follows',['class'=>'btn btn-primary']) }}
			<span class="help-block">Use this if you're not adding a new file to start to follow up to 1000 Twitter users from your uploaded list or until you are rate limited for following 1000 users.</span>
			</div>
		</div>
		{{ link_to_action('FollowController@index','Display Follows'); }}
 <span class="help-block">This will load all of your Follows. If you have a lot, it will take some time to load.</span>

  </div>
  <div class="tab-pane" id="Tweets">
		{{ link_to('/tweets','Your 5 Most Recent Tweets'); }}
  </div>
</div>
	</div>

	<div class="col-sm-3">
				<h2>Follow status</h2>
		<table id="status" class="table table-condensed">
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
