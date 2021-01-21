<?php
    include('../connectDB.php');
    include_once(dirname(__DIR__).'/Util/UserUtils.php');
    // ID a desbloquear
    $AccountID = $_GET['AccountID'];

    // function unblock() {
    //     global $connection, $AccountID;
    //     $ACCOUNT_BLOCKED = 0;
    //     $ACCOUNT_NORMAL  = 1;
    //     mysqli_query($connection, "UPDATE account SET Status='$ACCOUNT_NORMAL' WHERE account.AccountID='$AccountID'");
    //     mysqli_close($connection);
    // }

    // // Desbloquear
    // unblock();
    UserUtils::UnblockUser($AccountID);
    header("location: ../listUsers.php");
?>