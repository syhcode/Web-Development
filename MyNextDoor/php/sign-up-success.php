<?php

include "connectdb.php";

if (isset($_POST['email']) && isset($_POST['address']) && isset($_POST['name']) && isset($_POST['password'])) {

	date_default_timezone_set("America/New_York");
    $time = date("Y-m-d h-i-s");

    //create SQL query
    if ($stmt = $mysqli->prepare("INSERT INTO user(uname, address, email, password, time) VALUES (?, ?, ?, ?, ?);")) {
        $stmt->bind_param("sssss",  $_POST['name'], $_POST['address'],$_POST['email'], $_POST['password'], $time);
		//execute SQL query
		$stmt->execute();
        $stmt->close();
	}
}

echo <<<_END

<html lang="en">
	<head>
		<title>sign-up-success</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/sign-up-success.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/sign-up-success.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="well well-lg panel-group col-sm-offset-3 col-sm-6">
				<div class="panel panel-success">
					<div class="panel-heading">sign up success!</div>
					<div class="panel-body">Enjoy the time!</div>
					<button type="button" class="btn btn-success">Continue</button>	
				</div>
			</div>
		</div>
	</body>

</html>


_END
?>
