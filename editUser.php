<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Editar Utilizador</title>
    <link rel="stylesheet" href="css/style.css">

    <?php 
        $id = $_GET['id'];
        include('connectDB.php');
        $resultado = mysqli_query($connection, "SELECT * FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=".$id."");
        $res = mysqli_fetch_assoc($resultado);
    ?>

</head>

<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="userBox">
		<form method="POST" action="updateUser.php?id=<?php echo $id;?>">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family:sitkaSmall;">Editar Utilizador <br><?php echo $res['Username'];?></p>
            <p><input type="text" name="userid" value="<?php echo $id;?>" class="in" readonly></p>
			<p><input type="text" name="Name" value="<?php echo $res['Name'];?>" placeholder="Nome" class="in"></p>
            <p><input type="type" name="Mail" value="<?php echo $res['Mail'];?>" placeholder="E-Mail" class="in"></p>
            <p><input type="type" name="Username" value="<?php echo $res['Username'];?>" placeholder="Username" class="in"></p>
            <p><input type="password" name="Password" placeholder="Password" class="in"></p>
            <p><input type="password" name="repass" placeholder="Confirmar Password" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK"></p>
            </center>
		</form>
	</div>
</body>
</html>