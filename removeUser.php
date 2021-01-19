<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');

    $AccountID = $_GET['id'];

    $loggedUser = AuthenticationManager::AuthenticatedUser();
    if(UserUtils::GetUserID($loggedUser) == $AccountID) {
        // O utilizador é o que está logado atualmente
        $msg_title = "Erro!";
        $msg_body = "Nao pode remover o proprio utilizador!";
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
        return;
    }

    $msg_title = sprintf("Remover Utilizador %s (id:%d)", UserUtils::GetUsername($AccountID), $AccountID);
    $msg_body = sprintf("Tem a certeza que quer remover o utilizador?");

    // Action para remover o user
    $yes_callback = "userActions/remove.php?AccountID=$AccountID";
    $no_callback  = "listUsers.php";

    // MsgBox
    header("location: messageBoxYesNo.php?msg_title=$msg_title&msg_body=$msg_body&yes_callback=$yes_callback&no_callback=$no_callback#modal");
    // header(sprintf("location: messageBoxYesNo.php?msg_title=%s&msg_body=%s&yes_callback=%s&no_callback=%s#modal",
    //                 $msg_title, $msg_body, $yes_callback, $no_callback));
?>