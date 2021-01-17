<?php
    $name           = $_POST['Name'];
    $category       = $_POST['Category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $price          = $_POST['Price'];

    include('connectDB.php');
    mysqli_query($connection, "INSERT INTO product(Name, Category, UnitsInStock, UnitPrice) VALUES('$name', '$category', '$unitsInStock', '$price') ");
    header("location: listProducts.php");

?>