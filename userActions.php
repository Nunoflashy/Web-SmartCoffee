<?php
    $Action     = $_GET['action'];
    $AccountID  = $_GET['accountID'];
    include('connectDB.php');

    
    function removeUser() {
        global $connection, $AccountID;
        $sql = "DELETE a, u FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=$AccountID";
        mysqli_query($connection, $sql);
        mysqli_close($connection);
    }
    //removeUser();

    switch($Action) {
        case 'remove':
            removeUser();
        break;

        case 'Product':
        break;
    }

    
    // switch($ActionType) {
    //     case 'user':
    //         if($Action == "remove") {
    //             removeUser();
    //         }
    //     break;

    //     case 'Product':
    //     break;
    // }

?>