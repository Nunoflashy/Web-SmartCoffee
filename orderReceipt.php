<!-- MessageBox -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">

    <?php
        include_once('Util/Utils.php');
        include_once('Util/ProductUtils.php');
        include_once('Util/OrderUtils.php');
        $OrderID            = $_GET['OrderID'];
        $ProductIDList      = Util::ArrayFromURL($_GET['ProductIDList']);
        $UnitsOfEachProduct = Util::ArrayFromURL($_GET['UnitsOfEachProduct']);
        $OrderDate          = $_GET['OrderDate'];  
    ?>
</head>
<body>
<div style="background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="receiptBox">
        <center>
        <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
        <p style="font-family:sitkaSmall;">SmartCoffee</p>
        <p style="font-family:sitkaSmall;">Pedido: <?php echo $OrderID;?></p>
        <p style="font-family:sitkaSmall;"><?php echo '';?></p>
        <table border="1" style="color:white; font-family:sitkaSmall;">
            <th>Produto</th>
            <th>Qnt.</th>
            <th>Preço</th>
                <?php
                $productCount = 0;
                foreach($ProductIDList as &$p) {
                ?>
                    <tr>
                        <td><?php echo ProductUtils::GetName($p); ?></td>
                        <td><?php echo $UnitsOfEachProduct[$productCount];?></td>
                        <td><?php echo number_format((ProductUtils::GetPrice($p) * $UnitsOfEachProduct[$productCount]), 2);?>€</td>
                    </tr>
                <?php
                    $productCount++;
                }
            ?>
        </table>
        <!-- ------------------- -->
        <p style="font-family:sitkaSmall;">TOTAL: <?php
            function getTotalPrice() {
                global $ProductIDList, $UnitsOfEachProduct;
                $total = 0;
                $productIndex = 0;
                foreach($ProductIDList as &$p) {
                    $total += ($UnitsOfEachProduct[$productIndex] * ProductUtils::GetPrice($p));
                    $productIndex++;
                }
                return $total;
            }

            echo number_format(getTotalPrice(), 2);
        ?>€</p>
        <p style="font-family:sitkaSmall;">Data: <?php echo $OrderDate;?></p>
        <a href="order/completed.php" style="width:200px; height:50px; font-family:sitkaSmall;" class="in">OK</a>
        </center>
	</div>
</body>
</html>