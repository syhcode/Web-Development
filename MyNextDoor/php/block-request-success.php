<?php
session_start();

include "connectdb.php";


if (isset($_POST["uid"]) && isset($_SESSION['bid']) && $_SESSION["uid"]) {

    //create SQL query
    if ($stmt = $mysqli->prepare("INSERT INTO join_table(bid, uid, agreeid) VALUES (?, ?, ?);")) {

        $stmt->bind_param("iii",  $_SESSION["bid"], $_POST["uid"], $_SESSION["uid"] );
        //execute SQL query
        $stmt->execute();
        $stmt->close();
    } else {
        echo "insert error";
    }

    if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM join_table WHERE bid=? AND uid=?;")) {

        $stmt->bind_param("ii", $_SESSION['bid'], $_POST["uid"]);
        //execute SQL query
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                if ($count >= 3) {
                    if ($ins = $mysqli->prepare("UPDATE user SET bid=? WHERE uid=?;")) {
                        $ins->bind_param("ii", $_SESSION['bid'], $_POST["uid"]);
                        //execute SQL query
                        $ins->execute();
                        $ins->close();
                    } else {
                        echo "error 1";
                    }

                    if ($del = $mysqli->prepare("DELETE FROM request_table WHERE bid=? AND uid=?;")) {
                        $del->bind_param("ii", $_SESSION['bid'], $_POST["uid"]);
                        //execute SQL query
                        $del->execute();
                        $del->close();
                    }else {
                        echo "error 2";
                    }
                } else {
                    if ($sea = $mysqli->prepare("SELECT COUNT(*) FROM user WHERE bid=?;")) {
                        $sea->bind_param("i", $_SESSION['bid']);
                        //execute SQL query
                        $sea->execute();
                        $sea->bind_result($sum);
                        $sea->store_result();
                        while ($sea->fetch()) {
                            if ($sum == $count) {
                                if ($ins = $mysqli->prepare("UPDATE user SET bid=? WHERE uid=?;")) {
                                    $ins->bind_param("ii", $_SESSION['bid'], $_POST["uid"]);
                                    //execute SQL query
                                    $ins->execute();
                                    $ins->close();
                                } else {
                                    echo "error 3";
                                }

                                if ($del = $mysqli->prepare("DELETE FROM request_table WHERE bid=? AND uid=?;")) {
                                    $del->bind_param("ii", $_SESSION['bid'], $_POST["uid"]);
                                    //execute SQL query
                                    $del->execute();
                                    $del->close();
                                } else {
                                    echo "error 4";
                                }
                            }
                        }
                    }
                }
            }
        }
        $stmt->close();
    } else {
        echo "update error";
    }
} else {
    echo "apply stmt error";
}

echo <<<_END

<html lang="en">
	<head>
		<title>block-agree-success</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/sign-up-success.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/apply-success.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="well well-lg panel-group col-sm-offset-3 col-sm-6">
				<div class="panel panel-success">
					<div class="panel-heading">block-request-success!</div>
					<div class="panel-body">Enjoy the time!</div>
					<button type="button" class="btn btn-success">Continue</button>
				</div>
			</div>
		</div>
	</body>

</html>


_END
?>
