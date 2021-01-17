<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href='css/auth.css'>
    <title>Smart Coffee - Login</title>
    
    <?php
        include('master.php');
    ?>
</head>
<body>
    <div style="background-image: url('img/background.jpg'); width:100%; height:100%;">
    <div id="modal"></div>
    <div class="loginBox">
		<form method="POST" action="php/validasessao.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
			<p><input type="text" name="login" placeholder="Login" class="in"></p>
			<p><input type="password" name="password" placeholder="Password" class="in"></p>
            <p class="btn2"><input type="submit" name="btn_modal" value="Iniciar Sessão" ></p>
            </center>
		</form>
	</div>
</body>
</html>