<?php
    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];

    function isPasswordValid() {
        return ($password == $repass);
    }

    function userExists($user) {
        include('connectDB.php');
        global $username;
        $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
        return mysqli_num_rows($retval);
    }

    function addUser($u, $n, $m, $p) {
        include('connectDB.php');
        $hash = SHA1($p); //Hash pass
        $ACCOUNT_TYPE   = 1;
        $ACCOUNT_STATUS = 1;
        mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$u', '$hash', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
        mysqli_query($connection, "INSERT INTO user(Name, Mail) VALUES('$n', '$m') ");
    }

    if(!userExists($username)) {
        if($password != $repass) {
            echo "Passwords não coincidem!\n";
            return;
        }
        // Adicionar user
        addUser($username, $name, $mail, $password);
        
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