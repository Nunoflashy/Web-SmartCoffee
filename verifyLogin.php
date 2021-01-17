<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    function isLoginSuccessful() {
        global $username, $password;
        $hash = SHA1($password);

        include('connectDB.php');
        $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username' AND Password='$hash'");
        return mysqli_num_rows($retval);
    }

    if(isLoginSuccessful()) {
        header("location: showProducts.php");
    } else {
        // Login falhado
        header("location: login.php#modal");
    }
?>