<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Coffee</title>
    <link rel="stylesheet" type="text/css" href='css/styles.css'>
    <link rel="stylesheet" href="css/modal.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <header>
        <div id="menu">
            <a href="index.php"><img id="logo" src="img/Logo.png" style="width: 128px; height: auto; margin-top:20px;"></a>
            <div class="authSection">
                <?php
                    include('Util/AuthenticationManager.php');
                    $username = AuthenticationManager::AuthenticatedUser();
                    // Sem Login
                    if(!AuthenticationManager::IsUserLoggedIn()) {
                        $loginAction    = "login.php#modal";
                        $registerAction = "register.php#modal";
                ?>
                        <div class="authLogout" style="position:relative; text-align:center; width:140px; left:10%; top:20;"><a href="<?php echo $loginAction;?>" class="fas fa-sign-in-alt"></a>
                            <a href="<?php echo $loginAction;?>" style="color: white;">Login</a>
                        </div>
                        <div class="authLogout" style="position:relative; text-align:center; width:140px; left:10%; top:40;"><a href="<?php echo $registerAction;?>" class="fas fa-user-plus"></a>
                            <a href="<?php echo $registerAction;?>" style="color: white;">Registar</a>
                        </div>
                <?php
                    } else {
                    // Com Login
                        $AccountID = UserUtils::GetUserID($username);
                        $isAdmin = UserUtils::IsAdmin($AccountID);
                        $redirectAction = ($isAdmin) ? 'adminOverview.php' : 'showProducts.php';
                        $avatar = UserUtils::GetAvatar($AccountID);

                        // Fallback avatar
                        if($avatar == '') $avatar = "img/avatars/avatar.jpg";
                        
                        echo sprintf('<a href="%s"><img src="%s" class="authItem authIcon"></a>',
                                    $redirectAction, $avatar);
                ?>
                        <a class="authItem authUsername" href=""><?php echo $username;?></a>
                        <div class="authLogout"><a href="userActions/logout.php" class="fas fa-sign-out-alt"></a>
                            <a href="userActions/logout.php" style="color: white;">Logout</a>
                        </div>
                <?php
                    }
                ?>
                <!-- <a class="authItem" id="btnRegister" href="register.php#modal">Registar</a> -->
                <!-- <a class="authItem" id="btnLogin" href="login.php#modal"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Login</a>
                <a class="authItem" id="btnRegister" href="register.php#modal"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Registar</a> -->
                <!-- <img src="img/user.png" class="authItem authIcon" style="border-radius:100px; width:32px; height:32px;"> -->
                <!-- <a href="userActions/logout.php" class="authItem" style="color:red;">
                <?php
                    // session_start();
                    // if(isset($_SESSION['loggedUser'])) {
                    //     echo $_SESSION['loggedUser'];
                    // }
                ?>
                </a> -->

            </div> <!-- authSection -->
        </div>
    </header>
</body>
</html>