<?php
    require(dirname(__DIR__).'/admin/permissions.php');

    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    // ID a bloquear
    $AccountID = $_GET['AccountID'];
    UserUtils::BlockUser($AccountID);

    header("location: ../listUsers.php");
?>