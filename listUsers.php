<?php
    include_once('main.php');
    include_once('adminMenu.php');
    include_once('Util/UserUtils.php');
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
                $users = UserUtils::GetAllUsersID();
                foreach($users as &$u) {
                    $AccountID  = $u;
                    $Username   = UserUtils::GetUsername($AccountID);
                    $Name       = UserUtils::GetName($AccountID);
                    $Mail       = UserUtils::GetMail($AccountID);
                    $Type       = UserUtils::GetAccountType($AccountID);
                    $Status     = UserUtils::GetAccountStatus($AccountID);
                    $IsBlocked  = UserUtils::IsBlocked($Username);
                    $Avatar     = UserUtils::GetAvatar($AccountID);
                    ?>
                    <tr>
                        <td><img src="<?php echo $Avatar; ?>" class="avatar"></td>
                        <td style="text-align:center;"><?php echo $AccountID; ?></td>
                        <td style="text-align:center;"><?php echo $Username; ?></td>
                        <td style="text-align:center;"><?php echo $Name; ?></td>
                        <td style="text-align:center;"><?php echo $Mail; ?></td>
                        <td style="text-align:center;"> <!-- Tipo de Conta -->
                            <?php
                                switch($Type) {
                                    case UserUtils::$ACCOUNT_CUSTOMER: echo "Cliente"; break;
                                    case UserUtils::$ACCOUNT_ADMIN: echo "Administrador"; break;
                                }
                            ?>
                        </td>
                        <td style="text-align:center;"> <!-- Estado da Conta -->
                            <?php
                                echo $IsBlocked ? "Bloqueada" : "Normal";
                            ?>
                        </td>
                        <td><a href="editUser.php?id=<?php echo $AccountID;?>#modal" class="userDashboardAction"><i class="fas fa-edit"></i>Editar</a></td>
                        <td><a href="toggleBlockUser.php?id=<?php echo $AccountID;?>" class="userDashboardAction"><i class="fas fa-ban"></i>
                            <?php
                                echo $IsBlocked ? "Desbloquear" : "Bloquear";
                            ?>
                        </a></td>
                        <td><a href="removeUser.php?id=<?php echo $AccountID;?>" class="userDashboardAction"><i class="fas fa-trash-alt"></i>Remover</a></td>
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