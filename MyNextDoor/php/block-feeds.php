<?php
session_start();

include "connectdb.php";

// check the user;
if (isset($_POST['email']) && isset($_POST['password'])) {

    if ($stmt = $mysqli->prepare("SELECT uid, uname, bid, address FROM user WHERE email=? AND password=?;")) {

        $stmt->bind_param("ss", $_POST['email'], $_POST['password']);
        $stmt->execute();

        $stmt->bind_result($uid, $uname, $bid, $address);
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            $url = "sign-in.php";
            echo "<script type='text/javascript'>";
            echo "window.location.href='$url'";
            echo "</script>";
        } else {
            while ($stmt->fetch()) {
                $_SESSION["uid"] = htmlspecialchars($uid);
                $_SESSION["uname"] = htmlspecialchars($uname);
                $_SESSION["bid"] = htmlspecialchars($bid);

                $_SESSION["address"] = htmlspecialchars($address);
            }
        }
    }
}


$username;
if (isset($_SESSION["uname"])) {
    $username = $_SESSION["uname"];
} else {
    echo "no username";
}

$friend_list = array();
// get the friend-list
if ($stmt = $mysqli->prepare("SELECT uid, uname FROM friend, user WHERE aid=? AND friend.bid=uid AND agree='Y';")) {
    $stmt->bind_param("i", $_SESSION['uid']);
    $stmt->execute();
    $stmt->bind_result($friend_id, $friend_name);
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        while ($stmt->fetch()) {
            $friend_list["$friend_id"] = htmlspecialchars($friend_name);
        }
    }
} else {
    echo "prepare error!";
}

// post subject;
if (isset($_POST["optradio"]) && isset($_POST["share_message"])) {
    $range = $_POST["optradio"];
    $content = $_POST["share_message"];

    date_default_timezone_set("America/New_York");
    $time = date("Y-m-d h-i-s");

    $tid=0;
    if ($stmt = $mysqli->prepare("INSERT INTO thread(title, uid, time, scope) VALUES (?, ?, ?, ?);")) {
        $stmt->bind_param("siss", $content, $_SESSION['uid'], $time, $range);
        $stmt->execute();
        $stmt->close();
        $tid = $mysqli->insert_id;
    } else {
        echo "prepare error!";
    }


    if ($range == 'f') {
        $p = $_POST['receive_friend'];
        foreach ($p as $item => $value) {
            if ($stmt = $mysqli->prepare("INSERT INTO receive(uid, tid) VALUES (?, ?);")) {
                $stmt->bind_param("ii", $value, $tid);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

}


// reply message
if (isset($_POST["reply_message"]) && isset($_POST["towards_id"])) {
    $content = $_POST["reply_message"];
    $tid = $_POST["towards_id"];

    date_default_timezone_set("America/New_York");
    $time = date("Y-m-d h-i-s");

    if ($stmt = $mysqli->prepare("INSERT INTO message (time, content, tid, coordinate, uid) VALUES(?, ?, ?, ?, ?);")) {
        $stmt->bind_param("ssisi", $time, $content, $tid, $_SESSION["address"], $_SESSION["uid"]);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "reply message prepare error";
    }
}


echo <<<_END
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
	<li class="active"><a href="index.php">Home</a></li>
	<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Request
	<span class="caret"></span></a>
	<ul class="dropdown-menu">
	<li><a href="./friend-request.php">friend request</a></li>
	<li><a href="block-request.php">join block request</a></li>
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
	<li><a href="sign-out.php">sign out</a></li>
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
	<button type="button" class="btn btn-primary" id="block_feeds">block feeds</button>
	<button type="button" class="btn btn-primary" id="hood_feeds">hood feeds</button>
	<button type="button" class="btn btn-primary" id="new_message">new message</button>
	</div>
	</div>

	<div class="row col-sm-offset-1 col-sm-8 well">
	<div>
	<p class="post_name">Hello, $username!</p>
	<form method="post" action="index.php">
	<div>
	<textarea name="share_message" data-toggle="collapse"  class="post_message col-sm-12" data-target="#range_demo" placeholder="write something to share with others..."></textarea>
</div>

<div class="collapse post_range col-sm-11" id="range_demo">
	<div class="radio">
	<label><input type="radio" value="b" name="optradio">all block</label>
	</div>
	<div class="radio">
	<label><input type="radio" value="h" name="optradio">all hood</label>
	</div>
	<div class="radio">
	<label><input type="radio" value="f" name="optradio" data-toggle="modal" data-target="#select_recepient">specific friends</label>
	</div>
	<button type="submit" class="btn btn-success btn-xs col-sm-offset-10 col-sm-1 post_submit">post</button>
</div>


<!-- Modal -->
<div class="modal fade" id="select_recepient" role="dialog">
	<div class="modal-dialog">

<!-- Modal content-->
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">select recepient</h4>
	</div>
<div class="modal-body">
_END;
foreach ($friend_list as $item => $description) {
    echo <<<_END
		<label class="checkbox-inline"><input name="receive_friend[]" type="checkbox" value="$item">$description</label>
_END;
}

echo <<<_END
	</div>

	<div class="modal-footer">
	<button type="button" class="btn btn-success" data-dismiss="modal">Continue</button>
	</div>
	</div>

	</div>
	</div>

	</form>
	</div>
	</div>




_END;

if ($stmt = $mysqli->prepare("SELECT tid, title, thread.time, user.uname, user.address FROM thread, user
	WHERE thread.uid=user.uid AND ((user.bid=? AND scope='b') OR user.uid = ?) ORDER BY thread.time DESC;")
) {

    $stmt->bind_param("ii", $_SESSION["bid"], $_SESSION["uid"] );
    $stmt->execute();
    $stmt->bind_result($thread_tid, $thread_title, $thread_time, $thread_uname, $user_address);
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        $i = 0;
        while ($stmt->fetch()) {
            echo "<div class=\"row col-sm-offset-1 col-sm-8 well\">";
            echo "<div class=\"col-sm-12 well well-sm thread\" >";
            echo "<div class=\"col-sm-9\">";
            echo "<p class=\"post_name\">$thread_uname<span class=\"post_address\"> from " . substr($user_address, 0, 20) . "</span></p>";
            echo "</div>";
            echo "<div class=\"col-sm-3\">";
            echo "<p class=\"post_time\">$thread_time</p>";
            echo "</div>";
            echo "<p class=\"col-sm-9\">$thread_title</p>";
            echo "<button type=\"button\" data-toggle=\"collapse\" class=\"btn btn-success btn-xs col-sm-offset-1 col-sm-1 message_reply\" data-target=\"#reply_demo" . $i . "\">reply</button>";
            echo "</div>";


            if ($replystmt = $mysqli->prepare("SELECT user.uname, content, message.time, coordinate, tid FROM message, user
                                              WHERE message.uid=user.uid AND tid=?;")
            ) {
                //echo $thread_tid;
                $replystmt->bind_param("i", $thread_tid);
                $replystmt->execute();
                $replystmt->bind_result($message_uname, $message_content, $message_time, $message_coordinate, $message_tid);
                $replystmt->store_result();

                if ($replystmt->num_rows > 0) {
                    while ($replystmt->fetch()) {
                        echo "<table class=\"table\">";
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<td class=\"post_name\">$message_uname<span class=\"post_address\"> from " . substr($message_coordinate, 0, 10) . "</span></td>";
                        echo "<td class=\"content\">$message_content</td>";
                        echo "<td class=\"post_time\">$message_time</td>";
                        echo "</tr>";
                        echo "</tbody>";
                        echo "</table>";
                    }
                }

            } else {
                echo "no reply";
                echo "no reply";
                echo "no reply";
                echo "no reply";
            }

            echo "<div id=\"reply_demo" . $i . "\" class=\"collapse\">";
            echo "<form method=\"post\" action=\"index.php\">";
            echo "<textarea class=\"col-sm-9\" name=\"reply_message\" placeholder=\"write something...\"></textarea>";
            echo "<input type=\"hidden\" name=\"towards_id\" value=\"$thread_tid\">";
            echo "<button type=\"submit\" class=\"btn btn-success btn-xs col-sm-offset-1 col-sm-1 message_submit\">Submit</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"row col-sm-2\"> </div>";
            $i++;
        }
    } else {
        echo "no record";
    }
} else {
    echo "prepare error!";
}

echo <<<_END


	</div>
	</div>
	</body>
	</html>


_END;

?>
