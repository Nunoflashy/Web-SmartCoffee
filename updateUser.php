<?php require 'admin/permissions.php'; ?>

<?php
    $AccountID = $_GET['id'];
    $username  = $_POST['Username'];
    $name      = $_POST['Name'];
    $mail      = $_POST['Mail'];
    $accType   = $_POST['accType'];
    $pass      = $_POST['Password'];
    $repass    = $_POST['repass'];
    $avatar    = $_POST['avatar'];

    include_once('Util/UserUtils.php');
    include_once('Util/MessageBox.php');
    

    function hasPasswordUpdated() {
        global $connection, $AccountID, $pass;
        $sql    = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
        $res    = mysqli_fetch_assoc($sql);
        
        return $res['Password'] != SHA1($pass);
    }

    function isPasswordValid() {
        global $pass, $repass;
        return $pass == $repass;
    }

    function isPasswordEmpty() {
        global $pass;
        return $pass == "";
    }

    function existsOtherSameUsername() {
        global $connection, $username;
        $sql = mysqli_query($connection, "SELECT Username FROM account WHERE Username='$username'");
        $usernameList = array();
        while($res = mysqli_fetch_assoc($sql)) {
            array_push($usernameList, $res['Username']);
        }
        return sizeof($usernameList) > 1;
    }

    // function hasUsernameUpdated() {
    //     global $connection;
    //     global $AccountID, $username;
    //     $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
    //     $res = mysqli_fetch_assoc($sql);
    //     $thisUser   = $res['Username'];
    //     $thisUserID = $res['AccountID'];

    //     $usernameList = array();
    //     $sql = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
    //     while($res = mysqli_fetch_assoc($sql)) {
    //         array_push($usernameList, $res['Username']);
    //     }

    //     foreach($usernameList as &$user) {
    //         $otherUserID = UserUtils::GetUserByID($user);
    //         if($thisUserID == $otherUserID) {
    //             return false;
    //         }
    //     }
    //     return true;
    // }

    function existsSameUsername() {
        global $AccountID;
        $users  = UserUtils::GetAllUsersID();
        $thisID         = $AccountID;
        $thisUsername   = UserUtils::GetUsername($AccountID);
        printf("This ID: %d\nThis Username: %s<br><br>", $thisID, $thisUsername);
        foreach($users as &$uid) {
            $id         = $uid;
            $username   = UserUtils::GetUsername($uid);
            printf("AccountID: %d\nUsername: %s<br>", $id, $username);
            if(($username == $thisUsername) && $thisID != $id) {
                printf("<br>Found matching username!<br>");
                //return true;
            }
        }
        //die();
        //return false;
    }
    existsSameUsername();

    // die(hasUsernameUpdated());

    if(existsSameUsername()) {
        MessageBox::InfoMessage(
            "Ocorreu um erro",
            sprintf("O utilizador %s já existe!", $username),
            $ok_callback = "listUsers.php"
        )->show();
        return;
    }

    // Update User, Name, Mail
    UserUtils::SetUsername($AccountID, $username);
    UserUtils::SetName($AccountID, $name);
    UserUtils::SetMail($AccountID, $mail);
    
    // Nao atualizar avatar se nao for escolhido nenhum
    if($avatar) {
        UserUtils::SetAvatar($AccountID, $avatar);
    }

    // Update Tipo de Conta
    UserUtils::UpdateUserType($AccountID, $accType);

    // Update Pass
    if(!isPasswordEmpty()) {
        if(!hasPasswordUpdated()) {
            // A password inserida é a mesma da DB
            MessageBox::InfoMessage(
                "Ocorreu um erro!",
                "A password inserida é igual à que se encontra na base de dados!",
                $ok_callback = "listUsers.php"
            )->show();
            return;
        }
        if(isPasswordValid()) {
            UserUtils::SetPassword($AccountID, $pass);
        } else {
            // Pass não coincide
            MessageBox::InfoMessage(
                "Ocorreu um erro!",
                "As passwords não coincidem!",
                $ok_callback = "listUsers.php"
            )->show();
            return;
        }
    }

    header("location: listUsers.php");
?>