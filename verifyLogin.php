<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');

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
        $errorMsg = $auth->getError();
        header("location: messageInfo.php?msg_title=Erro&msg_body=$errorMsg&ok_callback=index.php#modal");
    }
?>