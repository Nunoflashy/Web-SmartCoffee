<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Smart Coffee - Vista Geral</title>

    <?php
        include('main.php');
        include('adminMenu.php');
        include('Util/UserUtils.php');
        include('Util/ProductUtils.php');
        include_once('Util/AuthenticationManager.php');

        $AccountID      = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());
        $isUserAdmin    = UserUtils::IsAdmin($AccountID);

        // Se nao estiver logado
        if(!$AccountID) {
            header("location: login.php#modal");
            return;
        }
        
        // Se nao for admin
        if(!$isUserAdmin) {
            header("location: showProducts.php");
            return;
        }

        $lastUserId     = UserUtils::GetLastUserID();
        $lastUsername   = UserUtils::GetUserByID($lastUserId);
        $users          = UserUtils::GetAllUsersID();
        $products       = ProductUtils::GetAllID();

        //Type
        $ACCOUNT_CUSTOMER = 1;
        $ACCOUNT_ADMIN = 2;
        // Status
        $ACCOUNT_BLOCKED = 0;
        $ACCOUNT_NORMAL = 1;
    ?>

</head>
<body>
<div style="background-image: url('img/backgroundUsers.png'); width:100%; height:200%; padding-top: 0px;">
    <center>
        <div class="adminCategory">
            <img src="img/overview.png" style="width:64px; height:auto; margin-left:1vh;"><br>Vista Geral
        </div>
        <div id="productsTable" style="margin-left: 50vh; margin-right:50vh;">
            <img style="justify-content:center;" class="" src="img/usersIcon.png">
            <p style="font-family:sitkaSmall; font-size:12pt;">Utilizadores</p>
            <table>
                <thead class="tableText">
                    <th></th>
                    <th >UserID</th>
                    <th>Username</th>
                    <th>Nome</th>
                    <th>Tipo de Conta</th>
                    <th>Estado da Conta</th>
                    <th>Data de Registo</th>
                    <th>Logins</th>
                </thead>
                <?php
                    foreach($users as &$u) {
                        $accountId      = $u;
                        $username       = UserUtils::GetUsername($accountId);
                        $name           = UserUtils::GetName($accountId);
                        $mail           = UserUtils::GetMail($accountId);
                        $accType        = UserUtils::GetAccountType($accountId);
                        $accStatus      = UserUtils::GetAccountStatus($accountId);
                        $registerDate   = UserUtils::GetRegisterDate($accountId);
                        $loginCount     = UserUtils::GetLoginCount($accountId);
                ?>
                    <tr class="tableText" style="font-size:10pt;">
                        <td><img class="usersImg" src="img/userIconCircle2.png" style="width:32px; height:auto;"></td>
                        <td style="text-align:center;"><?php echo $u;?></td>
                        <td style="text-align:center;"><?php echo $username;?></td>
                        <td style="text-align:center;"><?php echo $name;?></td>
                        <td style="text-align:center;"> <!-- Tipo de Conta -->
                            <?php
                                switch($accType) {
                                    case $ACCOUNT_CUSTOMER: echo "Cliente"; break;
                                    case $ACCOUNT_ADMIN: echo "Administrador"; break;
                                }
                            ?>
                        </td>
                        <td style="text-align:center;"> <!-- Estado da Conta -->
                            <?php
                                switch($accStatus) {
                                    case $ACCOUNT_BLOCKED: echo "Bloqueada"; break;
                                    case $ACCOUNT_NORMAL: echo "Normal"; break;
                                }
                            ?>
                        </td>
                        <td style="text-align:center;"><?php printf("%s", $registerDate);?></td>
                        <td style="text-align:center;"><?php printf("%s", $loginCount);?></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
        <div id="productsTable" style="margin-left: 50vh; margin-right:50vh; padding-bottom:20px;">
            <img style="justify-content:center; width:48px; height:auto;"class="" src="img/forkKnife.png">
            <p style="font-family:sitkaSmall; font-size:12pt;">Produtos</p>
            <table>
                <thead class="tableText">
                    <th></th>
                    <th>ProductID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Unidades</th>
                    <th>Preço</th>
                </thead>
                <?php
                    foreach($products as &$p) {
                        $productId = $p;
                        $name      = ProductUtils::GetName($productId);
                        $category  = ProductUtils::GetCategory($productId);
                        $units     = ProductUtils::GetStock($productId);
                        $price     = number_format(ProductUtils::GetPrice($productId), 2);
                ?>
                    <tr class="tableText" style="font-size: 10pt;">
                        <td><img class="usersImg" src="img/productsIconCircle.png" style="width:32px; height:auto;"></td>
                        <td style="text-align:center;"><?php echo $productId;?></td>
                        <td style="text-align:center;"><?php echo $name;?></td>
                        <td style="text-align:center;"><?php echo $category;?></td>
                        <td style="text-align:center;"><?php echo $units;?></td>
                        <td style="text-align:center;"><?php echo $price;?>€</td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </center>
</div>
</body>
</html>
