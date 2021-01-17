<?php
    $AccountID = $_GET['id'];

    include('connectDB.php');
    $sql = "DELETE a, u FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=$AccountID";
    mysqli_query($connection, $sql);
    //echo $AccountID;
    header("location: listUsers.php");
?>