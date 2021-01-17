<?php
    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];

    function isPasswordValid() {
        return ($password == $repass);
    }

    if(isPasswordValid()) {
        include('connectDB.php');
        $ACCOUNT_TYPE   = 1;
        $ACCOUNT_STATUS = 1;
        mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$username', '$password', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
        mysqli_query($connection, "INSERT INTO user(Name, Mail) VALUES('$name', '$mail') ");
        header("location: login.php#modal");
    } else {
        header("location: register.php#modal");
    }

?>