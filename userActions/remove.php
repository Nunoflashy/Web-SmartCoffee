<?php
    // ID a remover
    $AccountID = $_GET['AccountID'];

    include('../connectDB.php');

    function removeUser() {
        global $connection, $AccountID;
        $sql = "DELETE a, u FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=$AccountID";
        //mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
    
    // Remover o user
    removeUser();

    // Redirect
    header("location: ../listUsers.php");
?>