<?php
    include_once('UserUtils.php');
if(!class_exists("AuthenticationManager")) {
    class AuthenticationManager {
        private ?string $username = null;
        private ?string $password = null;

        private ?string $error = null;
        
        function __construct($u, $p) {
            $this->setDetails($u, $p);
        }

        function setDetails($u, $p) {
            $this->username = $u;
            $this->password = SHA1($p);
        }

        private function isEmpty() {
            return  $this->username == null ||
                    $this->password == null;
        }

        private function setError($msg) {
            $this->error = $msg;
        }

        public function getError() {
            return $this->error;
        }

        private function areDetailsCorrect() {
            global $connection;
            $username = $this->username;
            $password = $this->password;
            $hash = SHA1($password);
            $retval = mysqli_query($connection, "SELECT * FROM account WHERE Username='$username' AND Password='$password'");
            return mysqli_num_rows($retval);
        }

        function isLoginSuccessful() {
            $username = $this->username;
            $password = $this->password;
            if($this->isEmpty()) {
                $this->setError("Insira um username e uma password!");
                return false;
            }

            if(!$this->areDetailsCorrect()) {
                $this->setError("O username ou a password são inválidos!");
                return false;
            }

            if(UserUtils::IsBlocked($username)) {
                $this->setError("Esta conta encontra-se bloqueada!");
                return false;
            }

            return true;
        }

        // Authentication Control
        public static function SetAuthenticatedUser($u) {
            if(!isset($_SESSION['loggedUser']))
                session_start();
            $_SESSION['loggedUser'] = $u;
        }
        public static function AuthenticatedUser() {
            if(!isset($_SESSION['loggedUser']))
                session_start();
            return $_SESSION['loggedUser'];
        }
    }
}
?>