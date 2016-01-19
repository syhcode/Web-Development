<?php
session_start();
include "connectdb.php";



echo <<<_END
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Bootstrap Example</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/friend-list.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/friend-list.js"></script>
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
								<li><a href="#">friend request</a></li>
								<li><a href="block-request">join block request</a></li>
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
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group input-group">
							<input type="text" class="form-control" placeholder="Search..">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
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

				<div class="friend-content row col-sm-offset-1 col-sm-8 well">
					<div>
						<h3 id="list-title">friend list</h3>
					</div>

					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>sex</th>
								<th>Email</th>
								<th>address</th>
							</tr>
						</thead>

						<tbody>

_END;

if (isset($_SESSION['uid']) && isset($_SESSION['uname'])) {
// get the friend-list
    if ($stmt = $mysqli->prepare("SELECT uid, uname, email, address FROM friend, user WHERE aid=? AND friend.bid=uid AND agree='Y';")) {
        $stmt->bind_param("i", $_SESSION['uid']);
        $stmt->execute();
        $stmt->bind_result($friend_id, $friend_name, $friend_email, $friend_address);
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $friend_id = htmlspecialchars($friend_id);
                $friend_name = htmlspecialchars($friend_name);
                $friend_email = htmlspecialchars($friend_email);
                $friend_address = htmlspecialchars($friend_address);
echo <<<_END
							<tr>
								<td><a href="./friend-information.php?friend_id=$friend_id">$friend_name</a></td>
								<td>Male</td>
								<td>$friend_email</td>
								<td>$friend_address</td>
							</tr>
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

echo <<<_END
						</tbody>
					</table>

				</div>
			</div>
		</div>
	</body>
</html>


_END;
?>
