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

        // Formar o OrderID a partir destes valores
        //$_SESSION['OrderID'] = (100 + $AccountID + $LoginCount);
        $_SESSION['OrderID'] = OrderUtils::GetLastID() + 1;
        $OrderID = $_SESSION['OrderID'];

        $UnitPrice = $_SESSION['UnitPrice'];

        // Debug OrderID
        printf("OrderID: %s", $_SESSION['OrderID']);

        OrderUtils::AddProduct($OrderID, $ProductID, '1');
    }

    addProductToCustomer();

    // Redirecionar para a categoria certa
    header("location: category$Category.php#modal");
?>