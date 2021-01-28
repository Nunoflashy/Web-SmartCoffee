<?php require 'admin/permissions.php'; ?>
<?php
    include_once('Util/ProductUtils.php');
    include_once('Util/MessageBox.php');

    $ProductID = $_GET['id'];

    MessageBox::PromptMessage(
        sprintf("Remover produto %s (id: %d)", ProductUtils::GetName($ProductID), $ProductID),
        sprintf("Tem a certeza que quer remover o produto?"),
        $yes_callback = "productActions/remove.php?ProductID=$ProductID",
        $no_callback  = "listProducts.php"
    )->show();

    // $msg_title = sprintf("Remover produto %s (id: %d)", ProductUtils::GetName($ProductID), $ProductID);
    // $msg_body  = sprintf("Tem a certeza que quer remover o produto?");

    // // Actions
    // $yes_callback = "productActions/remove.php?ProductID=$ProductID";
    // $no_callback  = "listProducts.php";

    // // MsgBox
    // header("location: messageBoxYesNo.php?msg_title=$msg_title&msg_body=$msg_body&yes_callback=$yes_callback&no_callback=$no_callback#modal");
?>