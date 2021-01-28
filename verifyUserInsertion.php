<?php require 'admin/permissions.php'; ?>
<?php
    include_once('Util/RegistrationManager.php');
    include_once('Util/MessageBox.php');

    $name       = $_POST['name'];
    $mail       = $_POST['mail'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repass     = $_POST['repass'];
    $accType    = $_POST['accType'];
    $avatar     = $_POST['avatar'];

    $reg = new RegistrationManager($name, $mail, $username, $password, $repass);

    if($reg->isRegistrationSuccessful()) {
        UserUtils::AddUser($username, $name, $mail, $password);

        if($accType == UserUtils::$ACCOUNT_ADMIN) {
            UserUtils::SetAdmin($username);
        }

        if($avatar) {
            // Novo registo, portanto este user é o ultimo id
            $thisUserID = UserUtils::GetLastUserID();
            UserUtils::SetAvatar($thisUserID, $avatar);
        }

        header("location: listUsers.php");
    } else {
        MessageBox::InfoMessage("Erro ao adicionar utilizador!", $reg->getError(), $ok_callback = "listUsers.php")->show();
    }
?>