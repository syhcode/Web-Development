<?php

echo <<<_END

<html lang="en">
<head>
<title>sign up</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/map.css">	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/map.js"></script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY2z_ImrPUoyHiT60OS7Wlo9OU5JG_5pw&callback=initMap">
		</script>

		<link rel="stylesheet" type="text/css" href="../css/sign_up.css">
	</head>




	<body>
		<div class="container">

			<div  class="well well-lg main_menu">
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
								<p>Some text in the modal.</p>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Continue</button>
							</div>
						</div>


					</div>
				</div>

				<form role="form" action="./sign-up-success.php" method="post">
					<div class="form-group">
						<h3 class="title">Next Door</h3>
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


					<div class="row">
						<button type="submit" class="col-sm-4 btn btn-success">sign up</button>
					</div>


				</form>	
			</div>


		</div>
	</body>



</html>

_END;

?>
