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
        </tr>

        @endforeach
                
    </tbody>
</table>


        @else
                
        <p>Unfortunately, there are no users.</p>

                
        @endif  


</body>
</html>

