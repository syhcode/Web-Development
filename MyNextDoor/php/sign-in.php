<?php


echo <<<_END
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>sign in</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/sign_in.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/sign_in.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="well well-sm main_menu">
				<form role="form" action="index.php" method="post">
					<div class="form-group">
						<h3 class="title">Next Door</h3>
					</div>

					<div class="form-group">
						<label for="email">Email address:</label>
						<input type="email" name="email" class="form-control" id="email">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" name="password" class="form-control" id="pwd">
					</div>
					<div class="checkbox form-group">
						<label><input type="checkbox"> Remember me</label>
					</div>

					<div class="row">
						<button type="submit" class="col-sm-4 btn btn-success">sign in</button>
						<p class="hint col-sm-offset-2 col-sm-6">no account? <a href="sign-up.php">sign up</a></p>
					</div>
				</form>	

			</div>
		</div>
	</body>

</html>

_END
?>
