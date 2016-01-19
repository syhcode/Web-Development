<?php

session_start();

include "connectdb.php";

if (isset($_SESSION['uid']) && isset($_SESSION['uname']) && isset($_GET["friend_id"])) {
// get the friend-list

    $search_id = htmlspecialchars($_GET["friend_id"]);

    if ($stmt = $mysqli->prepare("SELECT uid, uname, address, profile, email FROM user WHERE uid = ?;")) {
        $stmt->bind_param("i", $search_id);
        $stmt->execute();
        $stmt->bind_result($personal_id, $personal_name, $personal_address, $personal_profile, $personal_email);
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                echo <<<_END
<html lang="en">
	<head>
		<title>Bootstrap Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/personal-information.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/personal-information.js"></script>
		<script type="text/javascript" src="../js/index.js"></script>
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
						<li class=""><a href="index.php">Home</a></li>
						<li class="dropdown active">
							<a class="dropdown-toggle " data-toggle="dropdown" href="#">Request
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">friend request</a></li>
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
				
				<div class="row col-sm-offset-1 col-sm-8 well">
					<div class="panel panel-success">
						<div class="panel-heading">personal information</div>
						<div class="col-sm-offset-2 panel-body">
							<p class="col-sm-3 person-key">Name:</p>
							<p class="col-sm-9 person-value">$personal_name</p>
							<p class="col-sm-3 person-key">sex:</p>
							<p class="col-sm-9 person-value">male</p>
							<p class="col-sm-3 person-key">address:</p>
							<p class="col-sm-9 person-value">$personal_address</p>
							<p class="col-sm-3 person-key">email:</p>
							<p class="col-sm-9 person-value">$personal_email</p>
							<p class="col-sm-3 person-key">profile:</p>
							<p class="col-sm-9 person-value">$personal_profile</p>
							<button type="button" class="friend-apply btn btn-success">APPLY</button>
						</div>
					</div>	

					<form id="friend-request" action="apply-success.php" method="post">
						<input type="hidden" name="personalId" value="$personal_id">
					</form>

					
				</div>
			</div>
		</div>
	</body>
</html>


_END;

            }
        }
    } else {
        echo "prepare error!";
    }
} else {
    $url = "sign-in.php";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";
}
?>
