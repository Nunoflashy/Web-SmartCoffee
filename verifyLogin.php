<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');
    include_once('Util/MessageBox.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new AuthenticationManager($username, $password);

    if($auth->isLoginSuccessful()) {
        $AccountID = UserUtils::GetUserID($username);
        // Atualizar LoginCount
        UserUtils::ModLoginCount($AccountID);

        // Definir o user logado
        AuthenticationManager::SetAuthenticatedUser($username);
        $isAdmin = UserUtils::IsAdmin($AccountID);
        if($isAdmin) {
            header("location: adminOverview.php");
        } else {
            header("location: showProducts.php");
        }
    } else {
        // Login falhado
        MessageBox::InfoMessage("Erro", $auth->getError(), $ok_callback = "index.php")->show();
    }
?>