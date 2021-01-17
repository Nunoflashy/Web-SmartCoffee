<?php
    include('connectDB.php');

    $AccountID = $_GET['id'];

    function isUserBlocked() {
        global $connection, $AccountID;
        $ACCOUNT_BLOCKED = 0;
        $ACCOUNT_NORMAL  = 1;
        
        $sql = mysqli_query($connection, "SELECT Status FROM account WHERE account.AccountID='$AccountID'");
        $res = mysqli_fetch_assoc($sql);
        return $res['Status'] == $ACCOUNT_BLOCKED;
    }

    $msg_title = sprintf("%s Utilizador id:%d", isUserBlocked() ? "Desbloquear" : "Bloquear", $AccountID);
    $msg_body = sprintf("Tem a certeza que quer %s o utilizador?", isUserBlocked() ? "desbloquear" : "bloquear");

    // Action para remover o user
    $yes_callback = sprintf("userActions/%s.php?AccountID=$AccountID", isUserBlocked() ? "unblock" : "block");
    $no_callback  = "listUsers.php";
    header(sprintf("location: messageBoxYesNo.php?msg_title=%s&msg_body=%s&yes_callback=%s&no_callback=%s#modal",
                    $msg_title, $msg_body, $yes_callback, $no_callback));
    // $AccountID = $_GET['id'];

    // $ACCOUNT_BLOCKED = 0;
    // $ACCOUNT_NORMAL  = 1;

    // include('connectDB.php');

    // function isUserBlocked() {
    //     global $connection, $AccountID;
    //     global $ACCOUNT_BLOCKED, $ACCOUNT_NORMAL;
        
    //     $sql = mysqli_query($connection, "SELECT Status FROM account WHERE account.AccountID='$AccountID'");
    //     $res = mysqli_fetch_assoc($sql);
    //     return $res['Status'] == $ACCOUNT_BLOCKED;
    // }

    // $status = isUserBlocked() ? $ACCOUNT_NORMAL : $ACCOUNT_BLOCKED;
    // mysqli_query($connection, "UPDATE account SET Status='$status' WHERE account.AccountID='$AccountID'");

    // header("location: listUsers.php");
?>