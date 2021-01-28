<?php
    include_once('Util/AuthenticationManager.php');
    include_once('Util/UserUtils.php');
    include_once('Util/OrderUtils.php');
    include_once('Util/ProductUtils.php');

    $ProductID = $_GET['id'];
    $Category  = $_GET['category'];
    $AccountID = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());

    function addProductToCustomer() {
        global $connection;
        global $ProductID, $AccountID;
        
        
        $LoginCount = UserUtils::GetLoginCount($AccountID);
        // Debug LoginCount
        echo $LoginCount.'<br>';

        // Formar o OrderID a partir destes valores
        //$_SESSION['OrderID'] = (100 + $AccountID + $LoginCount);
        $_SESSION['OrderID'] = OrderUtils::GetLastID() + 1;
        $OrderID = $_SESSION['OrderID'];

        // Debug OrderID
        printf("OrderID: %s", $_SESSION['OrderID']);
        printf("<br>Stock: %s<br>", ProductUtils::GetStock($ProductID));
        //die();
        
        if(OrderUtils::ProductExists($OrderID, $ProductID)) {
            if(ProductUtils::GetStock($ProductID) > 0) {
                OrderUtils::ModQuantity($OrderID, $ProductID, 1);
                array_push($_SESSION['UnitsOfEachProduct'], 1);
            }
            
        } else {
            OrderUtils::AddProduct($OrderID, $ProductID, '1');
            array_push($_SESSION['ProductIDList'], $ProductID);
        }
        
    }

    addProductToCustomer();
    

    // Redirecionar para a categoria certa
    header("location: category$Category.php#modal");
?>