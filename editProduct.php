<?php require 'admin/permissions.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Editar Produto</title>
    <link rel="stylesheet" type="text/css" href='css/styles.css'>
    <link rel="stylesheet" href="css/modal.css">

    <?php
        include_once("Util/ProductUtils.php");
        
        $id = $_GET['id'];
        $Name           = ProductUtils::GetName($id);
        $Category       = ProductUtils::GetCategory($id);
        $UnitsInStock   = ProductUtils::GetStock($id);
        $UnitPrice      = ProductUtils::GetPrice($id);
    ?>

</head>

<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="productBox">
		<form method="POST" action="updateProduct.php?id=<?php echo $id;?>">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family:sitkaSmall;">Editar Produto <br><?php echo $Name;?></p>
            <p><input type="text" name="userid" value="ID: <?php echo $id;?>" class="in" readonly></p>
			<p><input type="text" name="Name" value="<?php echo $Name;?>" placeholder="Nome do Produto" class="in"></p>
            <!-- <p><input type="text" name="Category" value="<?php ;?>" placeholder="Categoria" class="in"></p> -->
            <p><select name="Category" class="in" style="width:200px;">
                <option value="Cafetaria"   <?php echo $Category == "Cafetaria"  ? "selected" : ""?>>Cafetaria</option>
                <option value="Pastelaria"  <?php echo $Category == "Pastelaria" ? "selected" : ""?>>Pastelaria</option>
                <option value="Salgados"    <?php echo $Category == "Salgados"   ? "selected" : ""?>>Salgados</option>
                <option value="Bebidas"     <?php echo $Category == "Bebidas"    ? "selected" : ""?>>Bebidas</option>
                <option value="Tecnologia"  <?php echo $Category == "Tecnologia" ? "selected" : ""?>>Tecnologia</option>
            </select></p>
            <p><input type="number" name="UnitsInStock" value="<?php echo $UnitsInStock;?>" placeholder="Unidades em Stock" class="in"></p>
            <p><input type="text" name="UnitPrice" step="0.1" value="<?php echo $UnitPrice;?>€" placeholder="Preço Unitário" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>