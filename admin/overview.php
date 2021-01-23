<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Smart Coffee - Vista Geral</title>

    <?php
        include_once(dirname(__DIR__).'/main.php');
        include_once(dirname(__DIR__).'/adminMenu.php');
        include_once(dirname(__DIR__).'/Util/UserUtils.php');
        include_once(dirname(__DIR__).'/Util/ProductUtils.php');
        include_once(dirname(__DIR__).'/Util/AuthenticationManager.php');

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
<div style="background-image: url('img/backgroundUsers.png'); width:100%; height:auto; padding-top: 0px;">
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
                        $avatar         = UserUtils::GetAvatar($accountId);
                ?>
                    <tr class="tableText" style="font-size:10pt;">
                        <td><img class="usersImg" src="<?php echo $avatar; ?>" style="width:24px; height:24px; border-radius:50px;"></td>
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
                        <td><img class="usersImg" src="<?php echo ProductUtils::GetCategoryImage($productId); ?>" style="width:32px; height:auto;"></td>
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
        <div id="productsTable" style="margin-left: 50vh; margin-right:50vh; padding-bottom:20px;">
            <img style="justify-content:center; width:48px; height:auto;"class="" src="img/orders.png">
            <p style="font-family:sitkaSmall; font-size:12pt;">Pedidos</p>
            <table>
                <thead class="tableText">
                    <th></th>
                    <th>OrderID</th>
                    <th>Cliente</th>
                    <th>Data Efetuado</th>
                    <th>Preço</th>
                </thead>
                <?php
                    include_once('../Util/OrderUtils.php');
                    $orders = OrderUtils::GetAllID();
                    foreach($orders as &$o) {
                        $orderId = $o;
                        $accountId = OrderUtils::GetCustomer($o);
                        $customerName = UserUtils::GetUsername($accountId);
                        $orderDate = OrderUtils::GetDate($o);
                        $orderTotal = OrderUtils::GetTotal($o);
                ?>
                    <tr class="tableText" style="font-size: 10pt;">
                        <td><img class="usersImg" src="img/orders.png" style="width:24px; height:auto;"></td>
                        <td style="text-align:center;"><?php echo $orderId;?></td>
                        <td style="text-align:center;"><?php echo $customerName;?></td>
                        <td style="text-align:center;"><?php echo $orderDate;?></td>
                        <td style="text-align:center;"><?php echo $orderTotal;?>€</td>
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
