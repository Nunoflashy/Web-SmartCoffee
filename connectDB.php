<?php
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $database   = "smartcoffee";

    $connection = mysqli_connect($serverName, $dbUsername, $dbPassword);
    $db         = mysqli_select_db($connection, $database);
?>