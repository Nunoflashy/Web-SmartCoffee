<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Coffee - Produtos</title>

    <?php
        include('master.php');
    ?>

</head>

<body>
    <div style="background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
    <center>
        <!-- <div style="width:100%; height:100%; background-color: black; opacity: 0.5; position:absolute;"></div> -->
        <table id="productsTable">
            <thead>
                <th></th>
                <th>ProductID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Unidades</th>
                <th>Preço</th>
                <th></th>
                <th></th>
            </thead>
            <?php
                include('connectDB.php');
                $resultado = mysqli_query($connection, "SELECT * FROM product");
                while($res = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>
                        <td><img class="usersImg" src="img/product.png"></td>
                        <td><?php echo $res['ProductID'];?></td>
                        <td><?php echo $res['Name'];?></td>
                        <td><?php echo $res['Category'];?></td>
                        <td><?php echo $res['UnitsInStock'];?></td>
                        <td><?php echo number_format($res['UnitPrice'], 2);?>€</td>
                        <td><a class="" href="editProduct.php?id=<?php echo $res['ProductID'];?>"><i class="fas fa-edit"></i></td>
                        <td><a class="" href="removeProduct.php?id=<?php echo $res['ProductID'];?>"><i class="fas fa-trash-alt"></i></td>
                    </tr>
                    <?php
                }
            ?>
            <tr>
                <td><a href="addProduct.php#modal"><i class="fas fa-plus addProduct"></i></a></td>
            </tr>
        </table>
    </center>
</body>
</html>