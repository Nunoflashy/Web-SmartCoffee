<?php
    include_once('Util/AuthenticationManager.php');
    include_once('Util/UserUtils.php');
    include_once('Util/OrderUtils.php');

    $ProductID = $_GET['id'];
    $Category  = $_GET['category'];
    $AccountID = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());

    function addProductToCustomer() {
        global $connection;
        global $ProductID, $AccountID;
        
        
        $LoginCount = UserUtils::GetLoginCount(AuthenticationManager::AuthenticatedUser());
        // Debug LoginCount
        echo $LoginCount;

        $_SESSION['OrderID'] = (100 + $AccountID + $LoginCount);
        $OrderID = $_SESSION['OrderID'];

        $UnitPrice = $_SESSION['UnitPrice'];

        // Debug OrderID
        printf("OrderID: %s", $_SESSION['OrderID']);

        OrderUtils::AddProduct($OrderID, $ProductID, '1');
        // $sql = mysqli_query($connection, "INSERT INTO `order details` (OrderID, ProductID, Units) VALUES('$OrderID', '$ProductID', '1')");

        // mysqli_close($connection);
    }

    addProductToCustomer();

    // Redirecionar para a categoria certa
    header("location: category$Category.php#modal");
?>