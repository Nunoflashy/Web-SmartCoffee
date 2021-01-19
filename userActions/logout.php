<?php
    include_once(dirname(__DIR__).'/Util/AuthenticationManager.php');
    AuthenticationManager::Logout();
    
    // Redirect
    $index = '../index.php';
    header("location:".$index);
?>