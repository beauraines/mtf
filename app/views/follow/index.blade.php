@extends('layouts.default')
@section('content')

        <!-- @yield('content') -->

        @if ($follows->count()) 
                
<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Twitter Id</th>
            <th>Screen Name</th>
            <th>Follow Date</th>
            <th>Status Message</th>
            <th>Status Code</th>
            <th>filename</th>
            <th>MTF User</th>
            <th>Unfollow Date</th>
            <th>Created At</th>
            <th>Last Update</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($follows as $follow )

        <tr>
            <td>{{$follow->twitter_id}}</td>
            <td>{{ link_to("http://twitter.com/$follow->screenname",$follow->screenname) }}</td>
            <td>{{$follow->follow_date}}</td>
            <td>{{$follow->status_message}}</td>
            <td>{{$follow->status_code}}</td>
            <td>{{$follow->filename}}</td>
            <td>{{$follow->user_id}}</td>
            <td>{{$follow->unfollow_date}}</td>
            <td>{{$follow->created_at}}</td>
            <td>{{$follow->updated_at}}</td>
        </tr>

        @endforeach
                
    </tbody>
</table>


        @else
                
        <p>Unfortunately, there is no dataa.</p>

                
        @endif  


@stop
