<?php require 'admin/permissions.php'; ?>
<?php
    $name           = $_POST['Name'];
    $category       = $_POST['category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $price          = $_POST['Price'];

    include_once('Util/ProductUtils.php');
    include_once('Util/MessageBox.php');


    if(ProductUtils::Exists($name)) {
        MessageBox::InfoMessage("Erro", sprintf("O produto %s já existe!", $name), $ok_callback = "listProducts.php")->show();
        return;
    }

    mysqli_query($connection, "INSERT INTO product(Name, Category, UnitsInStock, UnitPrice) VALUES('$name', '$category', '$unitsInStock', '$price') ");
    header("location: listProducts.php");

?>