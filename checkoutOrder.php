<?php
    include_once('Util/Utils.php');
    include_once('Util/AuthenticationManager.php');
    include_once('Util/OrderUtils.php');
    include_once('Util/ProductUtils.php');

    session_start();
    // Get OrderID
    $OrderID = $_SESSION['OrderID'];
    $AccountID = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());

    global $connection;
    $datetime = date_create()->format('Y-m-d H:i:s');
    printf("%s", $datetime);

    $sql = mysqli_query($connection, "SELECT * FROM `order details` WHERE OrderID='$OrderID'");
    $res = mysqli_fetch_assoc($sql);

    $products = OrderUtils::GetProducts($OrderID);
    //$productPrice = ProductUtils::GetPrice($products[0]);
    //$unitsOfProduct = OrderUtils::GetUnits($OrderID, $products[0]);

    //$total = number_format($unitsOfProduct * $productPrice, 2);
    // echo '<br>';
    // echo $total;

    $orderTotalCostProducts = array();
    $ProductIDList = array();
    $UnitsOfEachProduct = array();

    echo '<br>';
    $totalPrice = 0;
    //Para cada produto p
    foreach($products as &$p) {
        // Get units
        $units = OrderUtils::GetUnits($OrderID, $p);

        // Atualizar stock
        ProductUtils::ModStock($p, -$units);

        // Cap stock
        if(ProductUtils::GetStock($p) < 0) {
            ProductUtils::SetStock($p, 0);
        }

        $unitPrice = ProductUtils::GetPrice($p);

        $productPrice = number_format($units * $unitPrice, 2);
        $totalPrice += $productPrice;
        
        // Adicionar cada produto
        array_push($ProductIDList, $p);

        // Adicionar cada quantidade do produto
        array_push($UnitsOfEachProduct, $units);

        // Preco total de cada produto
        $totalCostOfProduct = $productPrice;
        array_push($orderTotalCostProducts, $totalCostOfProduct);
    }

    // Adicionar o pedido
    OrderUtils::AddOrder($OrderID, $AccountID, $datetime);

    // Definir o custo total do pedido
    OrderUtils::SetTotal($OrderID, $totalPrice);
    
    
    $productIdList          = Util::ArrayToURL($ProductIDList);
    $unitsOfEachProduct     = Util::ArrayToURL($UnitsOfEachProduct);
    $orderTotalCostProducts = Util::ArrayToURL($orderTotalCostProducts);

    echo $orderTotalCostProducts;
    
    // Mostrar talao
    header("location: orderReceipt.php?OrderID=$OrderID&ProductIDList=$productIdList&UnitsOfEachProduct=$unitsOfEachProduct&OrderDate=$datetime#modal");
?>