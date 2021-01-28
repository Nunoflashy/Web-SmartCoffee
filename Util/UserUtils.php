<?php
    include(dirname(__DIR__).'/connectDB.php');

if(!class_exists("UserUtils")) {
    class UserUtils {
        static function IsBlocked($username) {
            $AccountID = self::GetUserID($username);
            return self::GetAccountStatus($AccountID) == self::$ACCOUNT_BLOCKED;
        }

        static function IsAdmin($AccountID) {
            return self::GetAccountType($AccountID) == self::$ACCOUNT_ADMIN;
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

        private static $ACCOUNT_ID = 0;
        private static $ACCOUNT_USERNAME = 1;

        private static function GetParamType($param) {
            switch(gettype($param)) {
                case "integer": return self::$ACCOUNT_ID;
                case "string":  return self::$ACCOUNT_USERNAME;
                default: die("Invalid parameter passed for user!");
            }
        }

        static function SetAdmin($username) {
            global $connection;
            $ACCOUNT_ADMIN = 2;
            $sql = mysqli_query($connection, "UPDATE account SET Type='$ACCOUNT_ADMIN' WHERE Username='$username'");
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
            global $connection;
            $hash = SHA1($password);
            $ACCOUNT_TYPE   = 1;
            $ACCOUNT_STATUS = 1;
            $datetime = date_create()->format('Y-m-d H:i:s');
            mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$username', '$hash', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
            mysqli_query($connection, "INSERT INTO user(Name, Mail, RegisterDate) VALUES('$name', '$mail', '$datetime') ");
        }

        static function ModLoginCount($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE account SET LoginCount=LoginCount+1 WHERE AccountID='$AccountID'");
        }

        static function Exists($username) {
            global $connection;
            $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            return mysqli_num_rows($retval);
        }

        static function RemoveUser($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "DELETE a, u FROM account a JOIN user u ON a.AccountID=u.AccountID WHERE a.AccountID=$AccountID");
        }

        static function SetAvatar($AccountID, $avatarImg) {
            global $connection;
            $avatarDir = "img/avatars";
            $avatar = sprintf("%s/%s", $avatarDir, $avatarImg);
            $sql = mysqli_query($connection, "UPDATE user SET ImgPath='$avatar' WHERE AccountID='$AccountID'");
        }

        static function GetAvatar($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT ImgPath FROM user WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            $avatar = $res['ImgPath'];
            
            // Sem avatar
            if($avatar == '') {
                $avatar = self::GetFallbackAvatar();
            }

            return $avatar;
        }
        
        static function GetFallbackAvatar() {
            $path = "img/avatars/avatar.jpg";
            return $path;
        }

        static function HasAvatar($AccountID) {
            return UserUtils::GetAvatar($AccountID) != '';
        }

        static function UpdateUserType($AccountID, $accType) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE account SET Type='$accType' WHERE account.AccountID='$AccountID'");
        }

        static function SetPassword($AccountID, $Password) {
            global $connection;
            $hash = SHA1($Password);
            $sql = mysqli_query($connection, "UPDATE account SET Password='$hash' WHERE AccountID='$AccountID'");
        }

        static function GetPasswordHash($AccountID) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT Password FROM account WHERE AccountID='$AccountID'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Password'];
        }

        static function SetName($AccountID, $Name) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE user SET Name='$Name' WHERE AccountID='$AccountID'");
        }

        static function SetMail($AccountID, $Mail) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE user SET Mail='$Mail' WHERE AccountID='$AccountID'");
        }

        static function SetUsername($AccountID, $Username) {
            global $connection;
            $sql = mysqli_query($connection, "UPDATE account SET Username='$Username' WHERE AccountID='$AccountID'");
        }

        static function BlockUser($AccountID) {
            global $connection;
            $blocked = self::$ACCOUNT_BLOCKED;
            $sql = mysqli_query($connection, "UPDATE account SET Status='$blocked' WHERE account.AccountID='$AccountID'");
        }

        static function UnblockUser($AccountID) {
            global $connection;
            $normal = self::$ACCOUNT_NORMAL;
            $sql = mysqli_query($connection, "UPDATE account SET Status='$normal' WHERE account.AccountID='$AccountID'");
        }

        // Account Types
        static $ACCOUNT_CUSTOMER = 1;
        static $ACCOUNT_ADMIN    = 2;

        // Account Status
        static $ACCOUNT_BLOCKED = 0;
        static $ACCOUNT_NORMAL  = 1;
    }
}
?>