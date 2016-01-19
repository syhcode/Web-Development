<?php
session_start();

include "connectdb.php";


if (isset($_POST["profile"]) && !empty($_POST["profile"]) && isset($_SESSION["uid"])) {

    //create SQL query
    if ($stmt = $mysqli->prepare("UPDATE user SET profile=? WHERE uid=?;")) {

        $stmt->bind_param("si", $_POST["profile"], $_SESSION["uid"]);
        //execute SQL query
        $stmt->execute();
        $stmt->close();
    } else {
        echo "update error";
    }
}

if (isset($_POST["block"]) && isset($_SESSION["uid"])) {
//create SQL query

    if ($sea = $mysqli->prepare("SELECT COUNT(*) FROM user WHERE bid=?;")) {
        $sea->bind_param("i", $_POST["block"]);
        //execute SQL query
        $sea->execute();
        $sea->bind_result($sum);
        $sea->store_result();
        while ($sea->fetch()) {
            if ($sum == 0) {
                if ($ins = $mysqli->prepare("UPDATE user SET bid=? WHERE uid=?;")) {
                    $ins->bind_param("ii", $_POST["block"], $_SESSION["uid"]);
                    //execute SQL query
                    $ins->execute();
                    $ins->close();
                }
            } else if ($sea2 = $mysqli->prepare("SELECT uid FROM request_table WHERE uid=?; ")) {
                $sea2->bind_param("i", $_SESSION["uid"]);
                //execute SQL query
                $sea2->execute();
                $sea2->bind_result($uid);
                $sea2->store_result();
                if ($sea2->num_rows == 0) {
                    if ($stmt = $mysqli->prepare("INSERT INTO request_table VALUES(?, ?); ")) {
                        echo $_SESSION["uid"];
                        $stmt->bind_param("ii", $_POST["block"], $_SESSION["uid"]);
                        //execute SQL query
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        echo "insert error";
                    }
                } else {
                    if ($stmt = $mysqli->prepare("UPDATE request_table SET bid=? WHERE uid=? ")) {
                        $stmt->bind_param("ii", $_POST["block"], $_SESSION["uid"]);
                        //execute SQL query
                        $stmt->execute();
                        $stmt->close();
                    } else {
                        echo "update error";
                    }

                }
            }
        }
    } else {
        echo "count error";
    }
} else {
    echo "block error";
    echo $_POST["block"];
}


echo <<<_END

<html lang="en">
	<head>
		<title>update-success</title>
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
					<div class="panel-heading">update success!</div>
					<div class="panel-body">Enjoy the time!</div>
					<button type="button" class="btn btn-success">Continue</button>
				</div>
			</div>
		</div>
	</body>

</html>


_END
?>
