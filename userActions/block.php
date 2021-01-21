<?php
    include('../connectDB.php');
    include_once(dirname(__DIR__).'/Util/UserUtils.php');

    // ID a bloquear
    $AccountID = $_GET['AccountID'];

    // function block() {
    //     global $connection, $AccountID;
    //     $ACCOUNT_BLOCKED = 0;
    //     $ACCOUNT_NORMAL  = 1;
    //     mysqli_query($connection, "UPDATE account SET Status='$ACCOUNT_BLOCKED' WHERE account.AccountID='$AccountID'");
    //     mysqli_close($connection);
    // }

    // Bloquear
    //block();
    UserUtils::BlockUser($AccountID);

    header("location: ../listUsers.php");
?>