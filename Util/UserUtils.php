<?php
    include('connectDB.php');

    class UserUtils {
        static function IsBlocked($username) {
            global $connection;
            $ACCOUNT_BLOCKED = 0;
            $ACCOUNT_NORMAL  = 1;
    
            $sql = mysqli_query($connection, "SELECT Status FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Status'] == $ACCOUNT_BLOCKED;
        }

        static function IsAdmin($username) {
            global $connection;
            $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($retval);
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
            global $connection;
            $ACCOUNT_ADMIN = 2;
            $sql = mysqli_query($connection, "UPDATE account SET Type='$ACCOUNT_ADMIN' WHERE Username='$username'");
            mysqli_close($connection);
        }

        static function GetUserByID($id) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE AccountID='$id'");
            $res = mysqli_fetch_assoc($sql);
            return $res['Username'];
        }

        static function GetUserID($username) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($sql);
            return $res['AccountID'];
        }

        static function GetLoginCount($username) {
            global $connection;
            $sql = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            $res = mysqli_fetch_assoc($sql);
            return $res['LoginCount'];
        }

        static function AddUser($username, $name, $mail, $password) {
            global $connection;
            $hash = SHA1($password);
            $ACCOUNT_TYPE   = 1;
            $ACCOUNT_STATUS = 1;
            mysqli_query($connection, "INSERT INTO account(Username, Password, Type, Status) VALUES('$username', '$hash', '$ACCOUNT_TYPE', '$ACCOUNT_STATUS') ");
            mysqli_query($connection, "INSERT INTO user(Name, Mail) VALUES('$name', '$mail') ");
            mysqli_close($connection);
        }

        static function Exists($username) {
            global $connection;
            $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username'");
            return mysqli_num_rows($retval);
        }
    }
?>