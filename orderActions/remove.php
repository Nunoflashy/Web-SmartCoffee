<?php
    include_once(dirname(__DIR__).'/Util/OrderUtils.php');
    $OrderID = $_GET['OrderID'];

    OrderUtils::RemoveOrder($OrderID);
    header("location: ../listOrders.php");
?>