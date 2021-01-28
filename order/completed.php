<?php
    session_start();
    var_dump($_SESSION['OrderID']);
    
    if(isset($_SESSION['OrderID'])) {
        unset($_SESSION['OrderID']);
        unset($_SESSION['ProductIDList']);
        unset($_SESSION['UnitsOfEachProduct']);
        unset($_SESSION['OrderDate']);
    }
    var_dump($_SESSION['OrderID']);
    //die();
    header("location: ../showProducts.php");
?>