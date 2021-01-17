<?php
    $ProductID      = $_GET['id'];
    $name           = $_POST['Name'];
    $category       = $_POST['Category'];
    $unitsInStock   = $_POST['UnitsInStock'];
    $unitPrice      = $_POST["UnitPrice"];

    include('connectDB.php');

    // Update User, Name, Mail
    mysqli_query($connection, "UPDATE product SET Name='$name', Category='$category', UnitsInStock='$unitsInStock', UnitPrice='$unitPrice' WHERE ProductID='$ProductID'");
    header("location: listProducts.php");
?>