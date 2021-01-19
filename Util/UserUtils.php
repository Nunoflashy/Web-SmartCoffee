<?php
    include(dirname(__DIR__).'/connectDB.php');
if(!class_exists("UserUtils")) {
    class UserUtils {
        static function IsBlocked($username) {
            global $connection;
            $ACCOUNT_BLOCKED = 0;
            $ACCOUNT_NORMAL  = 1;
    
            $sql = mysqli_query($connection, "SELECT Status FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Status'] == $ACCOUNT_BLOCKED;
        }

        static function IsAdmin($AccountID) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");

            if(!$sql) {
                die(mysqli_error($connection));
            }

            $res = mysqli_fetch_assoc($sql);
            $ACCOUNT_NORMAL = 1;
            $ACCOUNT_ADMIN  = 2;
            return $res['Type'] == $ACCOUNT_ADMIN;
        }
        
        static function HasAdminAccount() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account");
            $ACCOUNT_ADMIN = 2;
            while($res = mysqli_fetch_assoc($sql)) {
                if($res['Type'] == $ACCOUNT_ADMIN) {
                    return true;
                }
            }
            return false;
        }

        static function SetAdmin($username) {
            include('connectDB.php');
            $ACCOUNT_ADMIN = 2;
            $sql = mysqli_query($connection, "UPDATE account SET Type='$ACCOUNT_ADMIN' WHERE Username='$username'");
            mysqli_close($connection);
        }

        static function GetUserByID($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Username'];
        }

        static function GetUserID($username) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($sql);
            return $res['AccountID'];
        }

        static function GetLastUserID() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account");
            $user = null;
            while($res = mysqli_fetch_assoc($sql)) {
                $user = $res['AccountID'];
            }
            return $user;
        }

        static function GetUsername($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Username'];
        }

        static function GetName($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Name'];
        }

        static function GetMail($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Mail'];
        }

        static function GetAccountType($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Type'];
        }

        static function GetAccountStatus($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Status'];
        }

        static function GetAllUsersID() {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account");
            $users = array();
            while($res = mysqli_fetch_assoc($sql)) {
                array_push($users, $res['AccountID']);
            }
            return $users;
        }

        static function GetRegisterDate($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM user WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['RegisterDate'];
        }

        static function GetLoginCount($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['LoginCount'];
        }

        static function AddUser($username, $name, $mail, $password) {
            include('connectDB.php');
            $hash = SHA1($password);
            $ACCOUNT_TYPE   = 1;
            $ACCOUNT_STATUS = 1;
            $datetime = date_create()->format('Y-m-d H:i:s');
            mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$username', '$hash', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
            mysqli_query($connection, "INSERT INTO user(Name, Mail, RegisterDate) VALUES('$name', '$mail', '$datetime') ");
            mysqli_close($connection);
        }

        static function ModLoginCount($AccountID) {
            include('connectDB.php');
            $sql = mysqli_query($connection, "UPDATE account SET LoginCount=LoginCount+1 WHERE AccountID='$AccountID'");
            mysqli_close($connection);
        }

        static function Exists($username) {
            global $connection;
            $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            return mysqli_num_rows($retval);
        }

        static function RemoveUser($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "DELETE a, u FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=$AccountID");
            mysqli_close($connection);
        }

        static function SetAvatar($AccountID, $avatarImg) {
            global $connection;
            $avatarDir = "img/avatars";
            $avatar = sprintf("%s/%s", $avatarDir, $avatarImg);
            $sql = mysqli_query($connection, "UPDATE user SET ImgPath='$avatar' WHERE AccountID='$AccountID'");
            mysqli_close($connection);
        }

        static function GetAvatar($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT ImgPath FROM user WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['ImgPath'];
        }

        static function UpdateUserType($AccountID, $accType) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE account SET Type='$accType' WHERE account.AccountID='$AccountID'");
            mysqli_close($connection);
        }
    }
}
?>