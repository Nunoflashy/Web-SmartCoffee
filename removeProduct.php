<?php
    $ProductID = $_GET['id'];

    include('connectDB.php');
    $sql = "DELETE FROM product WHERE ProductID='$ProductID'";
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("location: listProducts.php");

?>