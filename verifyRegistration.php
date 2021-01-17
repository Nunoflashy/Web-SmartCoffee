<?php
    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];

    include('connectDB.php');

    function isPasswordValid() {
        global $password, $repass;
        return ($password == $repass);
    }

    function userExists($user) {
        global $connection;
        $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$user'");
        return mysqli_num_rows($retval);
    }

    function addUser($u, $n, $m, $p) {
        global $connection;
        $hash = SHA1($p); //Hash pass
        $ACCOUNT_TYPE   = 1;
        $ACCOUNT_STATUS = 1;
        mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$u', '$hash', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
        mysqli_query($connection, "INSERT INTO user(Name, Mail) VALUES('$n', '$m') ");
    }

    function hasAdminAccount() {
        global $connection;
        $ACCOUNT_ADMIN = 2;
        $retval = mysqli_query($connection, "SELECT * FROM account'");
        $res = mysqli_fetch_assoc($retval);
        return $retval['Type'] == $ACCOUNT_ADMIN;
    }

    if(!userExists($username)) {
        if($password != $repass) {
            echo "Passwords não coincidem!\n";
            return;
        }
        // Adicionar user
        addUser($username, $name, $mail, $password);
        
        // Se nao existir uma conta admin, definir esta como uma
        if(!hasAdminAccount()) {
            $ACCOUNT_ADMIN = 2;
            mysqli_query($connection, "UPDATE account SET Type='$ACCOUNT_ADMIN' WHERE account.Username='$username'");
        }
        
        // Redirect login
        header("location: login.php#modal");
    } else {
        // Redirect registration (login failed)
        header("location: register.php#modal");
    }

    // if(isPasswordValid()) {
    //     include('connectDB.php');
    //     $ACCOUNT_TYPE   = 1;
    //     $ACCOUNT_STATUS = 1;
    //     mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$username', '$password', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
    //     mysqli_query($connection, "INSERT INTO user(Name, Mail) VALUES('$name', '$mail') ");
    //     header("location: login.php#modal");
    // } else {
    //     header("location: register.php#modal");
    // }

?>