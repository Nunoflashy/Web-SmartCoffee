<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Cafetaria</title>

    <?php
        include("showProducts.php");
        include_once('Util/ProductUtils.php');

        $CATEGORY = "Salgados";
        $products = ProductUtils::GetAllIDFromCategory($CATEGORY);
    ?>

</head>
<body>
<div id="modal"></div>
    <div class="categoryBox">
		<form method="POST" action="">
            <center>
            <img src="img/category/savoryFoodsIcon.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family: sitkaSmall;">Salgados</p>
            <table id="" style="font-family:sitkaSmall;">
            <?php
                foreach($products as &$p) {
                    $productId      = $p;
                    $name           = ProductUtils::GetName($productId);
                    $unitsInStock   = ProductUtils::GetStock($productId);
                    $price          = number_format(ProductUtils::GetPrice($productId), 2);
                    if(ProductUtils::GetStock($p) > 0) {
                    ?>
                    <tr style="color:white;">
                        <td><img class="usersImg" style="width:32px; height:auto;" src="img/category/savoriesIconCircle.png"></td>
                        <td><?php echo $name;?></td>
                        <!-- <td><input type="number" name="quantity" class="in" style="width:40px;"></td> -->
                        <td><?php echo $price;?>€</td>
                        <td><a href="orderProduct.php?id=<?php echo $productId;?>&category=<?php echo $CATEGORY;?>"><i class="fas fa-plus addProduct"></i></a></td>
                    </tr>
                    <?php
                    }
                }
            ?>
        </table>
            <div style="color:white; font-family:sitkaSmall; font-size:16pt; background-color:rgba(46,46,46,.8); width:150px; border-radius:20px; padding: 5px 5px 5px 5px;">
                <a href="checkoutOrder.php" class="fas fa-shopping-cart fa-1x" style="margin-top:5px;"></a><br>
                <a href="checkoutOrder.php" style="font-size:12pt; color:white;">Finalizar Pedido</a>
            </div>
            </center>
		</form>
	</div>
</body>
</html>