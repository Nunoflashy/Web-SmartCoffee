<?php require dirname(__DIR__).'/admin/permissions.php'; ?>
<?php
    include_once('../Util/ProductUtils.php');
    
    $ProductID = $_GET['ProductID'];
    ProductUtils::RemoveProduct($ProductID);
    header("location: ../listProducts.php");
?>