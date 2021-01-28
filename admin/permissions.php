<?php
    include_once(dirname(__DIR__).'/Util/AuthenticationManager.php');
    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    $loggedUser = AuthenticationManager::AuthenticatedUser();
    $dirName = substr(getcwd(), strrpos(getcwd(), '\\')+1);
    $rootDir = "SmartCoffee";

    // User não logado
    if($loggedUser == null) {
        // Não estamos na root dir
        if($dirName != $rootDir) {
            header(sprintf("location: ../login.php#modal"));
        } else {
            header(sprintf("location: login.php#modal"));
        }
        exit();
    }
    
    $loggedUserId = UserUtils::GetUserID($loggedUser);

    // User é cliente
    if(!UserUtils::IsAdmin($loggedUserId)) {
        switch($dirName) {
            case $rootDir: header(sprintf("location: showProducts.php#modal")); break;
            default: header(sprintf("location: ../showProducts.php#modal")); break;
        }
        exit();
    }
?>