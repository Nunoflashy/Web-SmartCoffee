<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href='css/menu.css'>
    <link rel="stylesheet" type="text/css" href='css/footer.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Document</title>
</head>

<body onload="OnLoad();">
    <header>
        <div>
            <div><img id="logo" onmouseover="this.src='img/Logo.png'" onmouseout="this.src='img/LogoDisabled.png'" src="img/Logo.png"></div>
            
            <div id="menu">
                <div class="flex-container">
                    <div class="menuItem" id="btnOverview" onmouseenter="btn_onMouseEnter(1);"><img id="imgOverview" src="img/overviewIcon.png">Vista Geral</div>
                    <div class="menuItem" id="btnListUsers"><img id="imgListUsers" src="img/usersIcon.png">Ver Clientes</div>
                    <div class="menuItem" id="btnManageUsers"><img id="imgManageUsers" src="img/settingsIcon.png">Gerir Produtos</div>
                    <div id="authSection">
                        <a href="login.php#modal"><i class="fas fa-sign-in-alt"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <footer>
        <div class="flex-container">
            <div id="copyrightFooter"><b>© Smart Coffee 2021</b></div>
            <div id="social">
                <ul>
                    <li class="socialIcon"><i class='fas fa-backward'></i></li>
                </ul>
            </div>
            <img id="coffeeIcon" src="img/footerIcon.png">
            <div id="contacts">
                    <ul>
                        <b>Contactos</b>
                        <li class="contactItem"><i class='fas fa-phone-alt' style='font-size:12px'></i> 917140951</li>
                        <li class="contactItem"><i class='fas fa-phone-alt' style='font-size:12px'></i> 964817214</li>
                        <li class="contactItem"><i class='fas fa-envelope' style='font-size:12px'></i> support@smartcoffee.com</li>
                    </ul>

            </div>
        </div>
    </footer>

</body>
</html>