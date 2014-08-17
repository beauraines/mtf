@extends('layouts.default')
@section('content')

        @if ($users->count()) 
                
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Twitter</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)

        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{ link_to("http://twitter.com/$user->twitter_user",$user->twitter_user) }}</td>
            <!--<td>{{$user->twitter_user}}</td>-->
	    <!-- Display if keys set or not-->
        </tr>

        @endforeach
                
    </tbody>
</table>


        @else
                
        <p>Unfortunately, there are no users.</p>

                
        @endif  


@stop
