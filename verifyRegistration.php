<?php
    include_once('Util/RegistrationManager.php');
    include_once('Util/MessageBox.php');

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

        include_once('sendMail.php');
        sendMail(
            $mail,
            sprintf("Bem-Vindo ao Smart Coffee %s!", $name),
            sprintf("A sua conta %s foi registada no nosso sistema com sucesso!\nPode agora efetuar o login e começar a pesquisar o nosso catálogo!", $username)
        );
        // Redirect login
        header("location: login.php#modal");
    } else {
        MessageBox::InfoMessage("Erro no Registo!", $reg->getError(), $ok_callback = "index.php")->show();
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