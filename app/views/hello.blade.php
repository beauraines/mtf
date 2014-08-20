<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

<!-- Bootstrap -->


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<title>Manage Twitter Followers</title>
</head>
<body>

<style>
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}

.col-sm-6{
  text-align: center;
}

#navigation {
        height: 50px;
        /*width: 280px;
        margin-top: 60px;*/
        margin-left: 16px;
        float: right;
        color: #666666;
       font-size: 15px;
        list-style-type:none;
        padding: 0px;
}

#navigation li {
        display:inline;
        padding: 7px;
}

</style>



<div class="container">
	  <ul id="navigation">
           <li>{{ link_to_route('sessions.create','Login');}}</li>
           <li>{{ link_to_route('users.create','Sign up');}}</li>
	  </ul>
</div>

    <div class="container">
	<div class="jumbotron">
		<h2 >Manage Twitter Followers</h2>
	<img src="http://openclipart.org/people/jaschon/bluebird.svg" width=250/>
	</div>

	<div class="col-sm-6">
<strong>Features</strong><br>
<ul>
  <li>Follow Twitter users from a list
  <li>Respects twitters daily maximums
  <li>Picks up where it left off if your list is longer than the daily maximum.
</ul>

	</div>
	<div class="col-sm-6">
<strong>Coming Soon!</strong><br>
<ul>
  <li>Scheduled Tweets
  <li>Search twitter users
  <li>Integration with Instagram (which means a whole new name)
</ul>
	</div>



     </div>
</body>
</html>
