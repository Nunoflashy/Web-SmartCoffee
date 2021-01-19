<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href='css/auth.css'>
    <title>Smart Coffee - Registar</title>

    <?php
        include('main.php');
    ?>

</head>
<body>
<div style="background-image: url('img/background.jpg'); width:100%; height:100%;">
    <div id="modal"></div>
    <div class="registerBox">
		<form method="POST" action="verifyRegistration.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
			<p><input type="text" name="name" placeholder="Nome" class="in" required></p>
            <p><input type="type" name="mail" placeholder="E-Mail" class="in" required></p>
            <p><input type="type" name="username" placeholder="Username" class="in" required></p>
            <p><input type="password" name="password" placeholder="Password" class="in" required></p>
            <p><input type="password" name="repass" placeholder="Confirmar Password" class="in" required></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="Finalizar Registo"></p>
            </center>
		</form>
	</div>
</body>
</html>