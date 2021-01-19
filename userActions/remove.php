<?php
    include_once('../Util/UserUtils.php');

    $AccountID = $_GET['AccountID'];
    UserUtils::RemoveUser($AccountID);
    header("location: ../listUsers.php");
?>