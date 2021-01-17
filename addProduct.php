<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Coffee - Adicionar Produto</title>

</head>
<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%; background-repeat: no-repeat;">
<div id="modal"></div>
    <div class="userBox">
		<form method="POST" action="verifyProductInsertion.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
			<p><input type="text" name="Name" placeholder="Nome" class="in"></p>
            <!-- <p><input type="text" name="Category" placeholder="Categoria" class="in"></p> -->
            <p><select width="100" class="in">
                <option value="Cafetaria">Cafetaria</option>
                <option value="Bakery">Pastelaria</option>
                <option value="Savories">Salgados</option>
                <option value="Drinks">Bebidas</option>
                <option value="Technology">Tecnologia</option>
            </select></p>
            <p><input type="number" name="UnitsInStock" value="1" placeholder="Unidades em Stock" class="in"></p>
            <p><input type="number" name="Price" value="1.00" step="0.1" placeholder="Preço" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" style="width:150px;" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>