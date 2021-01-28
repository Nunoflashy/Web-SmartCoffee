<?php require 'admin/permissions.php'; ?>
<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');
    include_once('Util/MessageBox.php');

    $AccountID = $_GET['id'];

    $loggedUser = AuthenticationManager::AuthenticatedUser();

    if(UserUtils::GetUserID($loggedUser) == $AccountID) {
        // O utilizador é o que está logado atualmente
        MessageBox::InfoMessage("Erro", "Nao pode remover o proprio utilizador!", $ok_callback = "listUsers.php")->show();
        return;
    }

    MessageBox::PromptMessage(
        sprintf("Remover Utilizador %s (id:%d)", UserUtils::GetUsername($AccountID), $AccountID),
        sprintf("Tem a certeza que quer remover o utilizador?"),
        $yes_callback   = "userActions/remove.php?AccountID=$AccountID",
        $no_callback    = "listUsers.php"
    )->show();
?>