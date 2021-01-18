<?php
    include_once('Util/RegistrationManager.php');

    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];

    $reg = new RegistrationManager($name, $mail, $username, $password, $repass);

    if($reg->isRegistrationSuccessful()) {
        UserUtils::AddUser($username, $name, $mail, $password);
        // Se nao existir uma conta admin, definir esta como uma
        if(!UserUtils::HasAdminAccount()) {
            UserUtils::SetAdmin($username);
        }

        // Redirect login
        header("location: login.php#modal");
    } else {
        $msg_title = "Erro no Registo!";
        $msg_body = $reg->getError();
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=index.php#modal");
    }

    // if(!UserUtils::Exists($username)) {
    //     if($password != $repass) {
    //         echo "Passwords não coincidem!\n";
    //         return;
    //     }
    //     // Adicionar user
    //     UserUtils::AddUser($username, $name, $mail, $password);
        
    //     // Se nao existir uma conta admin, definir esta como uma
    //     if(!UserUtils::HasAdminAccount()) {
    //         UserUtils::SetAdmin($username);
    //     }
        
    //     // Redirect login
    //     header("location: login.php#modal");
    // } else {
    //     // Redirect registration (login failed)
    //     header("location: register.php#modal");
    // }

?>