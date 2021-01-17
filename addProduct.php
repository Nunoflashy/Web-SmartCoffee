<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Coffee - Adicionar Produto</title>

    <?php
        include('connectDB.php');
    ?>

</head>
<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="userBox">
		<form method="POST" action="verifyProductInsertion.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
			<p><input type="text" name="Name" placeholder="Nome" class="in"></p>
            <p><input type="text" name="Category" placeholder="Categoria" class="in"></p>
            <p><input type="text" name="UnitsInStock" placeholder="Unidades em Stock" class="in"></p>
            <p><input type="text" name="Price" placeholder="Preço" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK"></p>
            </center>
		</form>
	</div>
</body>
</html>