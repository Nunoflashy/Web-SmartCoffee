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

    function isUserAdmin() {
        global $username, $password;
        include('connectDB.php');
        $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
        $res = mysqli_fetch_assoc($retval);
        $ACCOUNT_NORMAL = 1;
        $ACCOUNT_ADMIN  = 2;
        return $res['Type'] == $ACCOUNT_ADMIN;
    }

    if(isLoginSuccessful()) {
        if(isUserAdmin()) {
            header("location: listUsers.php");
        } else {
            header("location: showProducts.php");
        }
    } else {
        // Login falhado
        $errorMsg = "O username ou a password estão incorretos.";
        header("location: messageInfo.php?msg_title=Erro&msg_body=$errorMsg&ok_callback=index.php#modal");
        //header("location: login.php#modal");
    }
?>