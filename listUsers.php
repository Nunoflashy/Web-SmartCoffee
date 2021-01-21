<?php
        include_once('Util/AuthenticationManager.php');

        //Type
        $ACCOUNT_CUSTOMER = 1;
        $ACCOUNT_ADMIN = 2;
        // Status
        $ACCOUNT_BLOCKED = 0;
        $ACCOUNT_NORMAL = 1;
        
        $AccountID      = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());
        $isUserAdmin    = UserUtils::IsAdmin($AccountID);

        if(!$isUserAdmin) {
            header("location: login.php#modal");
            return;
        }

        include_once('main.php');
        include_once('adminMenu.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <title>Smart Coffee - Utilizadores</title>
</head>

<body>
    <div style="top:0; background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
    <center>
        <div class="adminCategory">
            <img src="img/usersIcon.png" style="width:auto; height:auto; margin-left:1vh; padding-top:5px; padding-bottom: 5px;"><br>Gerir Utilizadores
        </div>
        <table id="usersTable">
            <thead>
                <th></th>
                <th>UserID</th>
                <th>Username</th>
                <th>Nome</th>
                <th>Mail</th>
                <th>Tipo de Conta</th>
                <th>Estado da Conta</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <?php
                include('connectDB.php');
                $resultado = mysqli_query($connection, "SELECT * FROM account a JOIN user u ON a.AccountID=u.AccountID");
                while($res = mysqli_fetch_assoc($resultado)) {
                    $id = $res['AccountID'];
                    $avatar = UserUtils::GetAvatar($id);
                    // Fallback avatar
                    if($avatar == '') $avatar = "img/avatars/avatar.jpg";
                    ?>
                    <tr>
                        <td><img src="<?php echo $avatar; ?>" style="width:24px; height:24px; border-radius:50px;"></td>
                        <td style="text-align:center;"><?php echo $res['AccountID']; ?></td>
                        <td style="text-align:center;"><?php echo $res['Username']; ?></td>
                        <td style="text-align:center;"><?php echo $res['Name']; ?></td>
                        <td style="text-align:center;"><?php echo $res['Mail']; ?></td>
                        <td style="text-align:center;"> <!-- Tipo de Conta -->
                            <?php
                                switch($res['Type']) {
                                    case $ACCOUNT_CUSTOMER: echo "Cliente"; break;
                                    case $ACCOUNT_ADMIN: echo "Administrador"; break;
                                }
                            ?>
                        </td>
                        <td style="text-align:center;"> <!-- Estado da Conta -->
                            <?php
                                switch($res['Status']) {
                                    case $ACCOUNT_BLOCKED: echo "Bloqueada"; break;
                                    case $ACCOUNT_NORMAL: echo "Normal"; break;
                                }
                            ?>
                        </td>
                        <td><a href="editUser.php?id=<?php echo $res['AccountID'];?>#modal" class="userDashboardAction"><i class="fas fa-edit"></i>Editar</a></td>
                        <td><a href="toggleBlockUser.php?id=<?php echo $res['AccountID'];?>" class="userDashboardAction"><i class="fas fa-ban"></i>
                            <?php
                                switch($res['Status']) {
                                    case $ACCOUNT_BLOCKED: echo "Desbloquear"; break;
                                    case $ACCOUNT_NORMAL: echo "Bloquear"; break;
                                }
                            ?>
                        </a></td>
                        <td><a href="removeUser.php?id=<?php echo $res['AccountID'];?>" class="userDashboardAction"><i class="fas fa-trash-alt"></i>Remover</a></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <div style="color:white; font-family:sitkaSmall; font-size:16pt; background-color:rgba(46,46,46,.8); width:150px; border-radius:50px; margin-top:30px;">
                <a href="addUser.php#modal" class="fas fa-plus-circle fa-1x" style="margin-top:5px;"></a><br>
                <a href="addUser.php#modal" style="font-size:12pt; color:white;">Adicionar</a>
        </div>
    </center>
</body>
</html>