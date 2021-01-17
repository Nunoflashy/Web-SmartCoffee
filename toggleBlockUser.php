<?php
    $AccountID = $_GET['id'];

    $ACCOUNT_BLOCKED = 0;
    $ACCOUNT_NORMAL  = 1;

    include('connectDB.php');

    function isUserBlocked() {
        global $connection, $AccountID;
        global $ACCOUNT_BLOCKED, $ACCOUNT_NORMAL;
        
        $sql = mysqli_query($connection, "SELECT Status FROM account WHERE account.AccountID='$AccountID'");
        $res = mysqli_fetch_assoc($sql);
        return $res['Status'] == $ACCOUNT_BLOCKED;
    }

    $status = isUserBlocked() ? $ACCOUNT_NORMAL : $ACCOUNT_BLOCKED;
    mysqli_query($connection, "UPDATE account SET Status='$status' WHERE account.AccountID='$AccountID'");

    header("location: listUsers.php");
?>