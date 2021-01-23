<?php
    require(dirname(__DIR__).'/admin/permissions.php');

    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    // ID a desbloquear
    $AccountID = $_GET['AccountID'];
    UserUtils::UnblockUser($AccountID);

    header("location: ../listUsers.php");
?>