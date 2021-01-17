<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Coffee - Cafetaria</title>

    <?php
        include("showProducts.php");
    ?>

</head>
<body>
<div id="modal"></div>
    <div class="categoryBox">
		<form method="POST" action="">
            <center>
            <img src="img/category/cafetariaIcon.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family: sitkaSmall;">Cafetaria</p>
            <table id="" style="font-family:sitkaSmall;">
            <?php
                include('connectDB.php');
                $resultado = mysqli_query($connection, "SELECT * FROM product");
                while($res = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>
                        <td><img class="usersImg" src="img/product.png"></td>
                        <td><?php echo $res['Name'];?></td>
                        <td><?php echo number_format($res['UnitPrice'], 2);?>€</td>
                        <td><a href="addProduct.php#modal"><i class="fas fa-plus addProduct"></i></a></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
            </center>
		</form>
	</div>
</body>
</html>