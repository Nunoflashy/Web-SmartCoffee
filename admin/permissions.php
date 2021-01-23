<?php
    include_once(dirname(__DIR__).'/Util/AuthenticationManager.php');
    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    $loggedUser = AuthenticationManager::AuthenticatedUser();

    if($loggedUser == null) {
        $dir = dirname(__DIR__);
        //die(sprintf("%s\index.php", $dir));
        header(sprintf("location:%s\login.php", $dir));
        exit();
    }
    
    $loggedUserId = UserUtils::GetUserID($loggedUser);

    if(!UserUtils::IsAdmin($loggedUserId)) {
        exit();
    }
?>