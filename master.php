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
            <div id="menu">
                <div><img id="logo" onmouseover="this.src='img/Logo.png'" onmouseout="this.src='img/LogoDisabled.png'" src="img/Logo.png"></div>
                <div class="flex-container">
                    <!-- <a class="menuItem" id="btnOverview" href="overview.php" onmouseenter="btn_onMouseEnter(1);"><img id="imgOverview" src="img/overviewIcon.png">Vista Geral</a>
                    <a class="menuItem" id="btnListUsers"><img id="imgListUsers" src="img/usersIcon.png">Ver Clientes</a>
                    <a class="menuItem" id="btnManageUsers"><img id="imgManageUsers" src="img/settingsIcon.png">Gerir Produtos</a> -->
                    <div id="authSection">
                        <p><a class="authItem" id="btnLogin" href="login.php#modal"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Login</a></p>
                        <a class="authItem" id="btnLogin" href="register.php#modal"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Registar</a>
                    </div> <!-- authSection -->
                </div> <!-- flex-container -->
            </div> <!-- menu -->

<!--             <div id="submenu">Submenu
                <div class="submenuItem" id="btnManageUsers"><img id="imgManageUsers" src="img/settingsIcon.png">Gerir Produtos</div>
            </div>   --><!-- submenu -->
        </div>
    </header>

    <footer>
        <div class="flex-container">
            <div class="f1">
                <div id="copyrightFooter"><b>© Smart Coffee 2021</b></div>
                <div id="social">
                    <ul>
                        <i class='fas fa-backward'></i>
                        <i class='fas fa-backward'></i>
                        <i class='fas fa-backward'></i>
                    </ul>
                </div>
            </div>

            <div class="f2">F2
                <img id="coffeeIcon" src="img/footerIcon.png">
            </div>
            <div class="f3">F3
                <div id="contacts">
                        <ul>
                            <b>Contactos</b>
                            <li class="contactItem"><i class='fas fa-phone-alt' style='font-size:12px'></i> 917140951</li>
                            <li class="contactItem"><i class='fas fa-phone-alt' style='font-size:12px'></i> 964817214</li>
                            <li class="contactItem"><i class='fas fa-envelope' style='font-size:12px'></i> support@smartcoffee.com</li>
                        </ul>
                </div>
            </div>

            

        </div>
    </footer>

</body>
</html>