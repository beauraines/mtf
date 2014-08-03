<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <!-- STYLES -->
        <link rel='stylesheet' type='text/css' href='/styles/stylesheet.css' /> 
        </style>

        <!-- SCRIPTS -->
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

	<script type="text/javascript" class="init">
		$(document).ready( function () {
    			$('#table_id').DataTable();
		} );
	</script>


</head>
<body>

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


</body>
</html>

