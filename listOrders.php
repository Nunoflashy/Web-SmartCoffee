<?php
    include_once('main.php');
    include_once('adminMenu.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <title>Smart Coffee - Pedidos</title>
</head>

<body>
    <div style="top:0; background-image: url('img/backgroundUsers.png'); width:100%; height:auto;">
    <center>
        <div class="adminCategory">
            <img src="img/orders.png" style="width:48px; height:auto; margin-left:1vh; padding-top:5px; padding-bottom: 5px;"><br>Ver Pedidos
        </div>
        <table id="usersTable">
            <thead>
                <th></th>
                <th>OrderID</th>
                <th>Username do Cliente</th>
                <th>Nome do Cliente</th>
                <th>Data Efetuado</th>
                <th>Preço Total</th>
            </thead>
            <?php
                include_once('Util/OrderUtils.php');
                $orders = OrderUtils::GetAllID();
                foreach($orders as &$o) {
                    $orderId = $o;
                    $accountId = OrderUtils::GetCustomer($o);
                    $customerUsername = UserUtils::GetUsername($accountId);
                    $customerName = UserUtils::GetName($accountId);
                    $orderDate = OrderUtils::GetDate($o);
                    $orderTotal = OrderUtils::GetTotal($o);
            ?>
                <tr class="tableText" style="font-size: 10pt;">
                    <td><img class="usersImg" src="img/orders.png" style="width:24px; height:auto;"></td>
                    <td style="text-align:center;"><?php echo $orderId;?></td>
                    <td style="text-align:center;"><?php echo $customerUsername;?></td>
                    <td style="text-align:center;"><?php echo $customerName;?></td>
                    <td style="text-align:center;"><?php echo $orderDate;?></td>
                    <td style="text-align:center;"><?php echo $orderTotal;?>€</td>
                </tr>
                <td>
                    <th></th>
                    <th>___________</th>
                    <th>___________</th>
                    <th>___________</th>
                    <th>___________</th>
                </td>
                <td style="text-align:center;">
                    <thead style="font-size:8pt;">
                        <th></th>
                        <th></th>
                        <th>ProductID</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Unidades</th>
                    </thead>

                </td>
                <?php
                // Retorna os produtos da order
                include_once('Util/ProductUtils.php');
                $products = OrderUtils::GetProducts($o);
                foreach($products as &$p) {
                    $productId = $p;
                    $productName = ProductUtils::GetName($p);
                    $productCategory = ProductUtils::GetCategory($p);
                    $unitsSold = OrderUtils::GetUnits($o, $p);
                ?>
                <tr class="tableText" style="font-size: 10pt;">
                    <td></td>
                    <td></td>
                    <td style="text-align:center;"><?php echo $productId;?></td>
                    <td style="text-align:center;"><?php echo $productName;?></td>
                    <td style="text-align:center;"><?php echo $productCategory;?></td>
                    <td style="text-align:center;"><?php echo $unitsSold;?></td>
                </tr>
            <?php
                    }
            ?>
            <thead style="font-size:8pt; text-align:center; left:50%;">
            <th></th>
            <th>_____________________________</th>
            <th>_____________________________</th>
            <th>_____________________________</th>
            <th>_____________________________</th>
            <th>_____________________________</th>
            </thead>
            <th></th>
            <th>OrderID</th>
            <th>Username do Cliente</th>
            <th>Nome do Cliente</th>
            <th>Data Efetuado</th>
            <th>Preço Total</th>
            
            <?php
                }
            ?>
        </table>
    </center>
</body>
</html>