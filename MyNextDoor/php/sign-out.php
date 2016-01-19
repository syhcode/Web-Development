<?php

/**
 * Created by PhpStorm.
 * User: Eason
 * Date: 12/29/15
 * Time: 1:57 PM
 */
session_start();

include "connectdb.php";

if (isset($_SESSION["uid"])) {

    date_default_timezone_set("America/New_York");
    $time = date("Y-m-d h-i-s");

    //create SQL query
    if ($stmt = $mysqli->prepare("UPDATE user SET time=\"$time\" WHERE uid=?;")) {
        $stmt->bind_param("i",  $_SESSION["uid"]);
        //execute SQL query
        $stmt->execute();
        $stmt->close();
    }

    //$_SESSION=array();
    //if (session_id() != "" || isset($_COOKIE[session_name()]))
      //  setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();

    $url = "sign-in.php";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>";


} else {
    echo "apply stmt error";
}


?>