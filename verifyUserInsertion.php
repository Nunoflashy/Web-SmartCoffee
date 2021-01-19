<?php
    include_once('Util/RegistrationManager.php');

    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];
    $accType    = $_POST['accType'];

    $ACCOUNT_NORMAL = 1;
    $ACCOUNT_ADMIN = 2;

    $reg = new RegistrationManager($name, $mail, $username, $password, $repass);

    if($reg->isRegistrationSuccessful()) {
        UserUtils::AddUser($username, $name, $mail, $password);

        if($accType == $ACCOUNT_ADMIN) {
            UserUtils::SetAdmin($username);
        }

        header("location: listUsers.php");
    } else {
        $msg_title = "Erro ao adicionar utilizador!";
        $msg_body = $reg->getError();
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
    }
?>