<?php require 'admin/permissions.php'; ?>
<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');
    include_once('Util/MessageBox.php');

    $AccountID = $_GET['id'];

    $loggedUser = AuthenticationManager::AuthenticatedUser();
    echo $loggedUser;
    echo UserUtils::GetUserID($loggedUser);

    if(UserUtils::GetUserID($loggedUser) == $AccountID) {
        // O utilizador é o que está logado atualmente
        MessageBox::InfoMessage("Erro", "Nao pode bloquear o proprio utilizador!", $ok_callback = "listUsers.php")->show();
        return;
    }

    $isUserBlocked = UserUtils::IsBlocked(UserUtils::GetUserByID($AccountID));

    MessageBox::PromptMessage(
        sprintf("%s Utilizador %s (id:%d)", $isUserBlocked ? "Desbloquear" : "Bloquear", UserUtils::GetUsername($AccountID), $AccountID),
        sprintf("Tem a certeza que quer %s o utilizador?", $isUserBlocked ? "desbloquear" : "bloquear"),
        $yes_callback = sprintf("userActions/%s?AccountID=$AccountID", $isUserBlocked ? "unblock.php" : "block.php"),
        $no_callback  = "listUsers.php"
    )->show();

    // $msg_title = sprintf("%s Utilizador id:%d", $isUserBlocked ? "Desbloquear" : "Bloquear", $AccountID);
    // $msg_body = sprintf("Tem a certeza que quer %s o utilizador?", $isUserBlocked ? "desbloquear" : "bloquear");

    // // Action para remover o user
    // $yes_callback = sprintf("userActions/%s.php?AccountID=$AccountID", $isUserBlocked ? "unblock" : "block");
    // $no_callback  = "listUsers.php";

    // // MsgBox
    // header(sprintf("location: messageBoxYesNo.php?msg_title=%s&msg_body=%s&yes_callback=%s&no_callback=%s#modal",
    //                 $msg_title, $msg_body, $yes_callback, $no_callback));
?>