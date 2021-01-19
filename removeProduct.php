<?php
    include_once('Util/ProductUtils.php');

    $ProductID = $_GET['id'];

    // $sql = "DELETE FROM product WHERE ProductID='$ProductID'";
    // mysqli_query($connection, $sql);
    // mysqli_close($connection);

    $msg_title = sprintf("Remover produto %s (id: %d)", ProductUtils::GetName($ProductID), $ProductID);
    $msg_body  = sprintf("Tem a certeza que quer remover o produto?");

    // Actions
    $yes_callback = "productActions/remove.php?ProductID=$ProductID";
    $no_callback  = "listProducts.php";

    // MsgBox
    header("location: messageBoxYesNo.php?msg_title=$msg_title&msg_body=$msg_body&yes_callback=$yes_callback&no_callback=$no_callback#modal");
?>