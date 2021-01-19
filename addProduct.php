<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">
    <title>Smart Coffee - Adicionar Produto</title>

</head>
<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%; background-repeat: no-repeat;">
<div id="modal"></div>
    <div class="productBox">
		<form method="POST" action="verifyProductInsertion.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family:sitkaSmall;">Adicionar Produto</p>
			<p><input type="text" name="Name" placeholder="Nome" class="in" required></p>
            <p><select name="category" class="in">
                <option value="Cafetaria">Cafetaria</option>
                <option value="Pastelaria">Pastelaria</option>
                <option value="Salgados">Salgados</option>
                <option value="Bebidas">Bebidas</option>
                <option value="Tecnologia">Tecnologia</option>
            </select></p>
            <p><input type="number" name="UnitsInStock" placeholder="Unidades em Stock" class="in" required></p>
            <p><input type="number" name="Price" step="0.1" placeholder="Preço" class="in" required></p>
            
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" style="width:200px; height:30px; border-radius:10px;" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>