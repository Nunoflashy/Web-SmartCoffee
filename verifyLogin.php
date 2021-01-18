<?php
    include_once('Util/UserUtils.php');
    include_once('Util/AuthenticationManager.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $auth = new AuthenticationManager($username, $password);

    if($auth->isLoginSuccessful()) {
        // Definir o user logado
        $sql = mysqli_query($connection, "UPDATE account SET LoginCount=LoginCount+1 WHERE Username='$username' ");
        mysqli_close($connection);
        AuthenticationManager::SetAuthenticatedUser($username);

        if(UserUtils::IsAdmin($username)) {
            header("location: listUsers.php");
        } else {
            header("location: showProducts.php");
        }
    } else {
        // Login falhado
        $errorMsg = $auth->getError();
        header("location: messageInfo.php?msg_title=Erro&msg_body=$errorMsg&ok_callback=index.php#modal");
    }
?>