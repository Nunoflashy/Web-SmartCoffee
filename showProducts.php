<?php
    include_once('main.php');
    include_once('Util/AuthenticationManager.php');
    $AccountID      = UserUtils::GetUserID(AuthenticationManager::AuthenticatedUser());
    $isUserAdmin    = UserUtils::IsAdmin($AccountID);

    // Se nao estiver logado
    if(!$AccountID) {
        header("location: login.php#modal");
        return;
    }
    
    // Se for admin
    if($isUserAdmin) {
        header("location: adminOverview.php");
        return;
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee - Produtos</title>
</head>
<body>
<div style="background-image: url('img/backgroundUsers.png'); width:100%; height:100%;">
    <div id="menu" style="margin-left:70vh;">
        <div class="flex-container">
            <a href="categoryCafetaria.php#modal" class="customerMenuItem" style="font-size:12pt;"><img class="imgCustomerIcon" src="img/category/cafetariaIcon.png">Cafetaria</a>
            <a href="categoryPastelaria.php#modal" class="customerMenuItem" style="font-size:12pt;"><img class="imgCustomerIcon" src="img/category/breadIcon.png">Pastelaria</a>
            <a href="categorySalgados.php#modal" class="customerMenuItem" style="font-size:12pt;"><img class="imgCustomerIcon" src="img/category/savoryFoodsIcon.png">Salgados</a>
            <a href="categoryBebidas.php#modal" class="customerMenuItem" style="font-size:12pt;"><img class="imgCustomerIcon" src="img/category/drinksIcon.png">Bebidas</a>
            <a href="categoryTecnologia.php#modal" class="customerMenuItem" style="font-size:12pt;"><img class="imgCustomerIcon" src="img/category/vrIcon.png">Tecnologia</a>
        </div>
    </div>
</body>
</html>