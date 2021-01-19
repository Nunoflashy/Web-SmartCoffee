<?php
    $name           = $_POST['Name'];
    $category       = $_POST['category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $price          = $_POST['Price'];

    include_once('Util/ProductUtils.php');


    if(ProductUtils::Exists($name)) {
        $msg_title = "Erro";
        $msg_body = sprintf("O produto %s já existe!", $name);
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listProducts.php#modal");
        return;
    }

    mysqli_query($connection, "INSERT INTO product(Name, Category, UnitsInStock, UnitPrice) VALUES('$name', '$category', '$unitsInStock', '$price') ");
    header("location: listProducts.php");

?>