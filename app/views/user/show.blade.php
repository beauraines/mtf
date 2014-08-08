@extends('layouts.default')
@section('content')
                
<table id="table_id" class="display"> 
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Twitter</th>
            <th>Token Status</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{ link_to("http://twitter.com/$user->twitter_user",$user->twitter_user) }}</td>
            <!--<td>{{$user->twitter_user}}</td>-->
	    <!-- Display if keys set or not-->
		@if ( ! isset($user->consumer_key) )

		<td> Twitter tokens not set. Please edit your settings.</td>

		@else

		<td> Tokens set. All okay.</td>
		
		@endif
        </tr>


                
    </tbody>
</table>

		{{ link_to("/users/$user->id/edit",'Edit settings') }}

@stop
