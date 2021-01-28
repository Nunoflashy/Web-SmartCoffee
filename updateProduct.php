<?php
    $ProductID      = $_GET['id'];
    $name           = $_POST['Name'];
    $category       = $_POST['Category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $unitPrice      = $_POST["UnitPrice"];

    include_once('Util/ProductUtils.php');

    //mysqli_query($connection, "UPDATE product SET Name='$name', Category='$category', UnitsInStock='$unitsInStock', UnitPrice='$unitPrice' WHERE ProductID='$ProductID'");
    ProductUtils::UpdateProduct($ProductID, $name, $category, $unitsInStock, $unitPrice);
    header("location: listProducts.php");
?>