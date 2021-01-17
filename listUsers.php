<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Smart Coffee - Utilizadores</title>

    <?php
        include('master.php');

        //Type
        $ACCOUNT_CUSTOMER = 1;
        $ACCOUNT_ADMIN = 2;
        // Status
        $ACCOUNT_BLOCKED = 0;
        $ACCOUNT_NORMAL = 1;
    ?>

</head>

<body>
    <div style="background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
    <center>
        <!-- <div style="width:100%; height:100%; background-color: black; opacity: 0.5; position:absolute;"></div> -->
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
                    ?>
                    <tr>
                        <td><img class="usersImg" src="img/user.png"></td>
                        <td><?php echo $res['AccountID']; ?></td>
                        <td><?php echo $res['Username']; ?></td>
                        <th><?php echo $res['Name']; ?></th>
                        <th><?php echo $res['Mail']; ?></th>
                        <th> <!-- Tipo de Conta -->
                            <?php
                                switch($res['Type']) {
                                    case $ACCOUNT_CUSTOMER: echo "Cliente"; break;
                                    case $ACCOUNT_ADMIN: echo "Administrador"; break;
                                }
                            ?>
                        </th>
                        <th> <!-- Estado da Conta -->
                            <?php
                                switch($res['Status']) {
                                    case $ACCOUNT_BLOCKED: echo "Bloqueada"; break;
                                    case $ACCOUNT_NORMAL: echo "Normal"; break;
                                }
                            ?>
                        </th>
                        <th><a href="editUser.php?id=<?php echo $res['AccountID'];?>#modal" class="userDashboardAction"><i class="fas fa-edit"></i>Editar</a></th>
                        <th><a href="toggleBlockUser.php?id=<?php echo $res['AccountID'];?>" class="userDashboardAction"><i class="fas fa-ban"></i>
                            <?php
                                switch($res['Status']) {
                                    case $ACCOUNT_BLOCKED: echo "Desbloquear"; break;
                                    case $ACCOUNT_NORMAL: echo "Bloquear"; break;
                                }
                            ?>
                        </a></th>
                        <th><a href="removeUser.php?id=<?php echo $res['AccountID'];?>" class="userDashboardAction"><i class="fas fa-trash-alt"></i>Remover</a></th>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </center>
</body>
</html>