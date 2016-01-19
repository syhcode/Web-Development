<?php
/**
 * Created by PhpStorm.
 * User: Eason
 * Date: 12/29/15
 * Time: 8:06 AM
 */

echo <<<_END

<html lang="en">
	<head>
		<title>update personal information</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/map.css">
		<link rel="stylesheet" type="text/css" href="../css/index.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/map.js"></script>
		<script type="text/javascript" src="../js/update-personal-information.js"></script>
		<script async defer
								 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY2z_ImrPUoyHiT60OS7Wlo9OU5JG_5pw&callback=initMap">
		</script>

		<link rel="stylesheet" type="text/css" href="../css/update-personal-information.css">

	</head>




	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">NEXTDOOR</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Request
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="./friend-request.php">friend request</a></li>
								<li><a href="#">join block request</a></li>
								<li><a href="#">Page 1-3</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Page 1-1</a></li>
								<li><a href="#">Page 1-2</a></li>
								<li><a href="#">Page 1-3</a></li>
							</ul>
						</li>
					</ul>
					<form id="search_form" method="post" action="person-list.php" class="navbar-form navbar-right" role="search">
						<div class="form-group input-group">
							<input type="text" name="search_name" class="form-control" placeholder="Search..">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button" id="search_start">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>

					<ul class="nav navbar-nav navbar-right">

						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> My Account
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="update-personal-information.php">edit profile</a></li>
                                <li><a href="friend-list.php">friend list</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="row col-sm-2">
					<div class="btn-group-vertical col-sm-12 well">
						<button type="button" class="btn btn-primary" id="friend_feeds">friend feeds</button>
						<button type="button" class="btn btn-primary" id="neighbor_feeds">neighbor feeds</button>
						<button type="button" class="btn btn-primary" id="block_feeds">block feeds</button>
						<button type="button" class="btn btn-primary" id="hood_feeds">hood feeds</button>
						<button type="button" class="btn btn-primary" id="new_message">new message</button>
					</div>
				</div>


				<div  class = "col-sm-offset-1 col-sm-6 well well-lg main_menu">
					<div id="map_modal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
							    <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">map</h4>
								</div>
								<div class="modal-body">
									<div id="buttonList">
										<input type=button id="hideMarkers" value="Hide Markers">
										<input id="showMarkers" type="button" value="Show All Markers">
										<input id="deleteMarkers" type="button" value="Delete Markers">
										<input type="textbox" id="address" placeholder="please input your address" style="width:200px;"/>
										<input type="button" id="submit" value="confirm">
									</div>

									<div id="map">

									</div>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
								</div>
							</div>


						</div>
					</div>



					<form role="form" action="./update-success.php" method="post">
						<div class="form-group">
							<h3 class="title">Update information</h3>
						</div>

						<div class="form-group">
							<label for="email">Email address:</label>
							<input type="email" name="email" class="form-control" id="email">
						</div>

						<div id="address_modal" class="form-group" data-toggle="modal" data-target="#map_modal">
							<label for="address">address</label>
							<input type="text" name="address" class="form-control" id="myAddress">
						</div>
						<div class="form-group">
							<label for="name">name</label>
							<input type="text" name="name" class="form-control" id="name">
						</div>

						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" name="password" class="form-control" id="pwd">
						</div>

						<div class="form-group">
							<label for="pwd">rePassword:</label>
							<input type="repassword" name="repassword" class="form-control" id="repwd">
						</div>

						<div class="form-group">
							<label for="pwd">profile:</label>
							<input type="text" name="profile" class="form-control" id="profile">
						</div>

                        <div class="form-group">
                        <div class="modal-body">
                            <label for="pwd">select block: </label>
                            <label class="checkbox-inline"><input id="block1" name="block" type="radio" value="1"> block1</label>
                            <label class="checkbox-inline"><input id="block2" name="block" type="radio" value="2"> block2</label>
                            <label class="checkbox-inline"><input id="block3" name="block" type="radio" value="3"> block3</label>
                            <label class="checkbox-inline"><input id="block4" name="block" type="radio" value="4"> block4</label>
					    </div>
					    </div>

						<div class="row">
		    		        <button type="submit" class="col-sm-offset-1 col-sm-2 btn btn-success">update</button>
       					</div>


					</form>
				</div>


			</div>
		</div>
	</body>



</html>







_END;

?>