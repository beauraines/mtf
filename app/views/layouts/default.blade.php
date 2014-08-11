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

<!-- Bootstrap -->


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">
<div style="float:left;">
@if  ( Auth::check()  ) 
 {{ 'Welcome ' . Auth::user()->name; }}
</div>
<div style="float:right;">
{{ link_to('/u','Main Page'); }} | {{ link_to('/logout','Logout'); }}
</div>

<hr>

@else

<div style="float:left;font-size:130%;">
<b>Manage Twitter Followers</b>
</div>
<div style="float:right;">
</div>

@endif
</div>
	@yield('content')

</body>
</html>
