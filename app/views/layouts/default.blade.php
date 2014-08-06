<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
        <!-- STYLES -->
        <link rel='stylesheet' type='text/css' href='styles/stylesheet.css' /> 
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
<div>
 {{ 'Welcome ' . Auth::user()->name; }}
<p>
{{ link_to('/u','Main Page'); }}
<p>
{{ link_to('/logout','Logout'); }}

</div>
	@yield('content')

</body>
</html>
