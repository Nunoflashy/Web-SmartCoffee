<?php
    require(dirname(__DIR__).'/admin/permissions.php');

    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    $AccountID = $_GET['AccountID'];
    UserUtils::RemoveUser($AccountID);

    header("location: ../listUsers.php");
    
?>