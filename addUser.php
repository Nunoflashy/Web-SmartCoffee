<?php require 'admin/permissions.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Adicionar Utilizador</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
<div style="background-image: url('img/backgroundEditUser.png'); width:100%; height:100%;">
<div id="modal"></div>
    <div class="userBox">
		<form method="POST" action="verifyUserInsertion.php">
            <center>
            <img src="img/logoSmall.png" style="opacity: 0.4; margin-top:10px; width: 64px;">
            <p style="font-family:sitkaSmall;">Adicionar Utilizador</p>
            <p><input type="text" name="name" placeholder="Nome" class="in" required></p>
            <p><input type="email" name="mail" placeholder="E-Mail" class="in" required></p>
            <p><input type="text" name="username" placeholder="Username" class="in" required></p>
            <p><input type="password" name="password" placeholder="Password" class="in" required></p>
            <p><input type="password" name="repass" placeholder="Confirmar Password" class="in" required></p>
            <div id="accTypeContainer">
                <p style="font-family:sitkaSmall; font-size:10pt; padding-top:10px;"><b>Tipo de Conta</b></p>
                <p>
                    <input type="radio" name="accType" value="1" checked>
                    <label for="1">Cliente</label><br>
                    <input type="radio" name="accType" value="2">
                    <label for="2">Administrador</label>
                </p>
            </div>
            <!-- Avatar -->
            <p style="font-family:sitkaSmall; font-size:10pt;">
                <label for="avatar" class="in" style="margin-top:-5px;font-size:10pt;color:white;">Escolher Avatar</label>
                <input name="avatar" id="avatar" type="file" accept="image/*" hidden>
            </p>
            <?php
                include_once('Util/UserUtils.php');
                $avatar = UserUtils::GetFallbackAvatar();
            ?>
            <!-- Mostrar avatar -->
                <img src="<?php echo $avatar; ?>" style="width:48px; height:48px; border-radius:50px;">
            <!-- End Avatar -->
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>