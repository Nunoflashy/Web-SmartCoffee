<?php
    include_once(dirname(__DIR__).'/Util/AuthenticationManager.php');
    include_once(dirname(__DIR__).'/Util/OrderUtils.php');
    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    $AccountID = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());

    if(!UserUtils::IsAdmin($AccountID)) {
        // Destruir order em progresso se for um cliente
        OrderUtils::DestroyOngoingOrder();
    }

    AuthenticationManager::Logout();
    
    // Redirect
    $index = '../index.php';
    header("location:".$index);
?>