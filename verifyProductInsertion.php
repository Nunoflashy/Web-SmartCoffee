<?php
    $name           = $_POST['Name'];
    $category       = $_POST['category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $price          = $_POST['Price'];

    include('connectDB.php');

    function productExists() {
        global $name;
        $sql = mysqli_query($connection, "SELECT * FROM product WHERE Name='$name'");
        return mysqli_num_rows($sql);
    }

    if(productExists()) {
        $msg_title = "Erro";
        $msg_body = sprintf("O produto %s já existe!\n", $name);
        header("location: messageInfo.php?msg_title=$msg_title&msg_body=$msg_body&ok_callback=listProducts.php#modal");
        return;
    }

    mysqli_query($connection, "INSERT INTO product(Name, Category, UnitsInStock, UnitPrice) VALUES('$name', '$category', '$unitsInStock', '$price') ");
    header("location: listProducts.php");

?>