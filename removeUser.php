<?php
    $AccountID = $_GET['id'];

    $msg_title = sprintf("Remover Utilizador id:%d", $AccountID);
    $msg_body = sprintf("Tem a certeza que quer remover o utilizador?");

    // Action para remover o user
    $yes_callback = "userActions/remove.php?AccountID=$AccountID";
    $no_callback  = "listUsers.php";
    header(sprintf("location: messageBoxYesNo.php?msg_title=%s&msg_body=%s&yes_callback=%s&no_callback=%s#modal",
                    $msg_title, $msg_body, $yes_callback, $no_callback));
    //header("location: messageBoxYesNo.php?msg_title=$msg_title&msg_body=$msg_body&yes_callback=$yes_callback&no_callback=$no_callback#modal");
?>