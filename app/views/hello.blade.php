<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Manage Twitter Followers</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
			background-color: aliceblue;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -200px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
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

#navigation a {
        font-weight: bold;
}

#navigation a:link,
#navigation a:visited {

        color:#666666;
        text-decoration: none;
}

#navigation a:hover {

        color:#666666;
        text-decoration:underline;
}

		
	</style>
</head>
<body>
<div>
	  <ul id="navigation">
           <li>{{ link_to_route('sessions.create','Login');}}</li>
           <li>{{ link_to_route('users.create','Sign up');}}</li>
	  </ul>
</div>


	<div class="welcome">
		<h1>Manage Twitter Followers</h1>
	<a href="http://openclipart.org/detail/69181/bluebird-by-jaschon"><img src="http://openclipart.org/people/jaschon/bluebird.svg" /></a>

	</div>
</body>
</html>
