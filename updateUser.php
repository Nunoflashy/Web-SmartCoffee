<?php
    $AccountID = $_GET['id'];
    $username  = $_POST['Username'];
    $name      = $_POST['Name'];
    $mail      = $_POST['Mail'];
    $accType   = $_POST['accType'];
    $pass      = $_POST['Password'];
    $repass    = $_POST['repass'];
    $avatar    = $_POST['avatar'];

    include_once('Util/UserUtils.php');

    function hasPasswordUpdated() {
        global $connection, $AccountID, $pass;
        $sql    = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
        $res    = mysqli_fetch_assoc($sql);
        
        return $res['Password'] != SHA1($pass);
    }

    function isPasswordValid() {
        global $pass, $repass;
        return $pass == $repass;
    }

    function isPasswordEmpty() {
        global $pass;
        return $pass == "";
    }

    function hasUsernameChanged() {
        global $connection;
        global $username;
        $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
        $res = mysqli_fetch_assoc($sql);
        return $res['Username'] != $username;
    }

    // if(UserUtils::Exists($username) && hasUsernameChanged()) {
    //     $msg_title = "Ocorreu um erro!";
    //     $msg_body = sprintf("O utilizador %s já existe!", $username);
    //     header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    //     return;
    // }

    // Update User, Name, Mail
    mysqli_query($connection, "UPDATE account SET Username='$username' WHERE account.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Name='$name' WHERE user.AccountID='$AccountID'");
    mysqli_query($connection, "UPDATE user SET Mail='$mail' WHERE user.AccountID='$AccountID'");
    
    // Nao atualizar avatar se nao for escolhido nenhum
    if($avatar) {
        UserUtils::SetAvatar($AccountID, $avatar);
    }

    // Update Tipo
    //mysqli_query($connection, "UPDATE account SET Type='$accType' WHERE account.AccountID='$AccountID'");
    UserUtils::UpdateUserType($AccountID, $accType);

    // Update Pass
    if(!isPasswordEmpty()) {
        if(!hasPasswordUpdated()) {
            // A password inserida é a mesma da DB
            $msg_title = "Ocorreu um erro!";
            $msg_body = "A password inserida é igual à que se encontra na base de dados!";
            header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
            return;
        }
        if(isPasswordValid()) {
            $hash = SHA1($pass);
            mysqli_query($connection, "UPDATE account SET Password='$hash' WHERE account.AccountID='$AccountID'");
        } else {
            // Pass não coincide
            $msg_title = "Ocorreu um erro!";
            $msg_body = "As passwords não coincidem!";
            header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
            return;
        }
        $msg_title = "Sucesso!";
        $msg_body = "A password foi alterada com sucesso!";
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    }

    header("location: listUsers.php");
?>