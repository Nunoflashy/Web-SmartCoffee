<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Editar Produto</title>
    <link rel="stylesheet" type="text/css" href='css/styles.css'>
    <link rel="stylesheet" href="css/modal.css">

    <?php 
        $id = $_GET['id'];
        include('connectDB.php');
        $resultado = mysqli_query($connection, "SELECT * FROM product WHERE ProductID=".$id."");
        $res = mysqli_fetch_assoc($resultado);
    ?>

</head>

<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="productBox">
		<form method="POST" action="updateProduct.php?id=<?php echo $id;?>">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family:sitkaSmall;">Editar Produto <br><?php echo $res['Name'];?></p>
            <p><input type="text" name="userid" value="ID: <?php echo $id;?>" class="in" readonly></p>
			<p><input type="text" name="Name" value="<?php echo $res['Name'];?>" placeholder="Nome do Produto" class="in"></p>
            <p><input type="text" name="Category" value="<?php echo $res['Category'];?>" placeholder="Categoria" class="in"></p>
            <p><input type="number" name="UnitsInStock" value="<?php echo $res['UnitsInStock'];?>" placeholder="Unidades em Stock" class="in"></p>
            <p><input type="text" name="UnitPrice" step="0.1" value="<?php echo $res['UnitPrice'];?>€" placeholder="Preço Unitário" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>