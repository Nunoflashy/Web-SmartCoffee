<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href='css/styles.css'>
    <link rel="stylesheet" type="text/css" href='css/modal.css'>
    <title>Smart Coffee - Editar Utilizador</title>

    <?php
        include_once('Util/UserUtils.php');
        include_once('Util/AuthenticationManager.php');

        $id = $_GET['id'];
        
        $resultado = mysqli_query($connection, "SELECT * FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=".$id."");
        $res = mysqli_fetch_assoc($resultado);

        $ACCOUNT_CUSTOMER = 1;
        $ACCOUNT_ADMIN    = 2;

        $accType = $res['Type'];

        $AccountID      = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());
        $isUserAdmin    = UserUtils::IsAdmin($AccountID);
        
        if(!$isUserAdmin) {
            header("location: login.php#modal");
            return;
        }
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
            <p><input type="text" name="userid" value="ID: <?php echo $id;?>" class="in" readonly></p>
			<p><input type="text" name="Name" value="<?php echo $res['Name'];?>" placeholder="Nome" class="in"></p>
            <p><input type="text" name="Mail" value="<?php echo $res['Mail'];?>" placeholder="E-Mail" class="in"></p>
            <p><input type="text" name="Username" value="<?php echo $res['Username'];?>" placeholder="Username" class="in" 
            <?php
                // Definir como readonly se for o utilizador logado atualmente
                include('Util/AuthenticationManager.php');
                echo (AuthenticationManager::AuthenticatedUser() == $res['Username']) ? "readonly" : "";
            ?> ></p>
            <div id="accTypeContainer" style="width:200px; height:100px; border-radius:5px; background-color:rgba(46,46,46,.8);">
                <p style="font-family:sitkaSmall; font-size:10pt; padding-top:10px;"><b>Tipo de Conta</b></p>
                <p>
                    <input type="radio" name="accType" value="1" <?php echo ($accType == $ACCOUNT_CUSTOMER) ? 'checked="checked"' : '';?>>
                    <label for="1">Cliente</label><br>
                    <input type="radio" name="accType" value="2" <?php echo ($accType == $ACCOUNT_ADMIN) ? 'checked="checked"' : '';?>>
                    <label for="2">Administrador</label>
                </p>
            </div>

            <!-- Avatar -->
            <p style="font-family:sitkaSmall; font-size:10pt;">
                <label for="avatar" class="in" style="margin-top:-5px;font-size:10pt;color:white;">Escolher Avatar</label>
                <input name="avatar" id="avatar" type="file" accept="image/*" hidden>
            </p>
            <?php
                $avatar = UserUtils::GetAvatar($id);
                // Fallback avatar
                if($avatar == 'NULL') $avatar = "img/avatars/avatar.jpg";
            ?>
            <!-- Mostrar avatar -->
            <img src="<?php echo $avatar; ?>" style="width:48px; height:48px; border-radius:50px;">
            <!-- End Avatar -->

            <p><input type="password" name="Password" placeholder="Password" class="in"></p>
            <p><input type="password" name="repass" placeholder="Confirmar Password" class="in"></p>
            <p><input type="submit" name="btnOK" id="btnOK" value="OK" class="in"></p>
            </center>
		</form>
	</div>
</body>
</html>