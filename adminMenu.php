<?php require 'admin/permissions.php'; ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Smart Coffee - Dashboard</title>
</head>
<body>
    <div id="menu">
        <div class="flex-container" style="margin-left:50vh;">
        <a href="adminOverview.php" class="adminMenuItem" style="font-size: 12pt;"><img class="adminItemIcon" src="img/overview.png">Vista Geral</a>
        <a href="listUsers.php" class="adminMenuItem" style="font-size: 12pt;"><img class="adminItemIcon" src="img/usersIcon.png">Gerir Utilizadores</a>
        <a href="listProducts.php" class="adminMenuItem" style="font-size: 12pt;"><img class="adminItemIcon" src="img/forkKnife.png">Gerir Produtos</a>
        <a href="listOrders.php" class="adminMenuItem" style="font-size: 12pt;"><img class="adminItemIcon" src="img/orders.png">Ver Pedidos</a>
    </div>
</body>
</html>