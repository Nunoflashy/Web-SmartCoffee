<?php
    $AccountID = $_GET['id'];
    $username  = $_POST['Username'];
    $name      = $_POST['Name'];
    $mail      = $_POST['Mail'];
    $accType   = $_POST['accType'];
    $pass      = $_POST['Password'];
    $repass    = $_POST["repass"];

    function hasPasswordUpdated() {
        return $pass != "";
    }

    function isPasswordValid() {
        return $pass == $repass;
    }

    include('connectDB.php');

    // Update User, Name, Mail
    mysqli_query($connection, "UPDATE account SET Username='$username' WHERE account.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Name='$name' WHERE user.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Mail='$mail' WHERE user.AccountID='$AccountID'");

    // Update Tipo
    mysqli_query($connection, "UPDATE account SET Type='$accType' WHERE account.AccountID='$AccountID'");

    // Update Pass
    if(hasPasswordUpdated() && isPasswordValid()) {
        mysqli_query($connection, "UPDATE account, user SET Password='$pass' WHERE account.AccountID='$AccountID'");
    }

    header("location: listUsers.php");
?>