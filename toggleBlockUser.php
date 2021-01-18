<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');

    $AccountID = $_GET['id'];

    $loggedUser = AuthenticationManager::AuthenticatedUser();
    echo $loggedUser;
    echo UserUtils::GetUserID($loggedUser);

    if(UserUtils::GetUserID($loggedUser) == $AccountID) {
        // O utilizador é o que está logado atualmente
        $msg_title = "Erro!";
        $msg_body = "Nao pode bloquear o proprio utilizador!";
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listUsers.php#modal");
        return;
    }

    $isUserBlocked = UserUtils::IsBlocked(UserUtils::GetUserByID($AccountID));

    $msg_title = sprintf("%s Utilizador id:%d", $isUserBlocked ? "Desbloquear" : "Bloquear", $AccountID);
    $msg_body = sprintf("Tem a certeza que quer %s o utilizador?", $isUserBlocked ? "desbloquear" : "bloquear");

    // Action para remover o user
    $yes_callback = sprintf("userActions/%s.php?AccountID=$AccountID", $isUserBlocked ? "unblock" : "block");
    $no_callback  = "listUsers.php";

    // MsgBox
    header(sprintf("location: messageBoxYesNo.php?msg_title=%s&msg_body=%s&yes_callback=%s&no_callback=%s#modal",
                    $msg_title, $msg_body, $yes_callback, $no_callback));
?>