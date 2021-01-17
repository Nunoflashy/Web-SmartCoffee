<?php
    $AccountID = $_GET['id'];
    $username  = $_POST['Username'];
    $name      = $_POST['Name'];
    $mail      = $_POST['Mail'];
    $accType   = $_POST['accType'];
    $pass      = $_POST['Password'];
    $repass    = $_POST["repass"];

    include('connectDB.php');

    function userExists() {
        global $connection, $username;
        $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
        return mysqli_num_rows($retval);
    }

    function hasPasswordUpdated() {
        global $connection, $pass;
        $sql    = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
        $retval = mysqli_fetch_assoc($sql);

        return SHA1($retval['Password']) != SHA1($pass);
    }

    function isPasswordValid() {
        global $pass, $repass;
        return $pass == $repass;
    }

    // if(userExists()) {
    //     $msg_title = "Erro";
    //     $msg_body = sprintf("O utilizador %s (id:%d) já existe!", $username, $AccountID);
    //     header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    //     return;
    // }

    // Update User, Name, Mail
    mysqli_query($connection, "UPDATE account SET Username='$username' WHERE account.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Name='$name' WHERE user.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Mail='$mail' WHERE user.AccountID='$AccountID'");

    // Update Tipo
    mysqli_query($connection, "UPDATE account SET Type='$accType' WHERE account.AccountID='$AccountID'");

    // Update Pass
    if(hasPasswordUpdated()) {
        if(isPasswordValid()) {
            $hash = SHA1($pass);
            mysqli_query($connection, "UPDATE account SET Password='$hash' WHERE account.AccountID='$AccountID'");
        } else {
            // Passwords invalidas
            $msg_title = "Ocorreu um erro!";
            $msg_body = "As passwords não coincidem!";
            header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
            return;
        }
        $msg_title = "Sucesso!";
        $msg_body = "A password foi alterada com sucesso!";
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    } else {
        // A password inserida é a mesma da DB
        $msg_title = "Ocorreu um erro!";
        $msg_body = "A password inserida é igual à que se encontra na base de dados!";
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    }

    //header("location: listUsers.php");
?>