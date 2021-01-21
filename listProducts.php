<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Produtos</title>

    <?php
        include('main.php');
        include('adminMenu.php');
        include('Util/ProductUtils.php');

        $products = ProductUtils::GetAllID();
    ?>
</head>

<body>
    <div style="background-image: url('img/backgroundUsers.png'); width:100%; height:auto;">
    <center>
        <div class="adminCategory">
            <img src="img/forkKnife.png" class="adminCategoryImg"><br>Gerir Produtos
        </div>
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
                foreach($products as &$p) {
                    $productId = $p;
                    $name       = ProductUtils::GetName($p);
                    $category   = ProductUtils::GetCategory($p);
                    $units      = ProductUtils::GetStock($p);
                    $price      = number_format(ProductUtils::GetPrice($p), 2);
            ?>
                    <tr>
                        <td><img class="usersImg" src="<?php echo ProductUtils::GetCategoryImage($productId); ?>" style="width:32px; height:auto;">
                        </td>
                        <td style="text-align:center;"><?php echo $productId;?></td>
                        <td style="text-align:center;"><?php echo $name;?></td>
                        <td style="text-align:center;"><?php echo $category;?></td>
                        <td style="text-align:center;"><?php echo $units;?></td>
                        <td style="text-align:center;"><?php echo $price;?>€</td>
                        <td><a class="userDashboardAction" href="editProduct.php?id=<?php echo $productId;?>#modal"><i class="fas fa-edit"></i>Editar</a></td>
                        <td><a class="userDashboardAction" href="removeProduct.php?id=<?php echo $productId;?>"><i class="fas fa-trash-alt"></i>Remover</a></td>
                    </tr>
                    <?php
                }
            ?>
            <tr>
                <!-- <td><a href="addProduct.php#modal" style="justify-content:center;"><i class="fas fa-plus addProduct"></i></a></td> -->
            </tr>
        </table>
        <div style="color:white; font-family:sitkaSmall; font-size:16pt; background-color:rgba(46,46,46,.8); width:150px; border-radius:50px; margin-top:30px;">
            <a href="addProduct.php#modal" class="fas fa-plus-circle fa-1x" style="margin-top:5px;"></a><br>
            <a href="addProduct.php#modal" style="font-size:12pt; color:white;">Adicionar</a>
        </div>
    </center>
</body>
</html>