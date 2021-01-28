<?php
    include_once('UserUtils.php');

    class RegistrationManager {
        private $username = null;
        private $password = null;
        private $name     = null;
        private $mail     = null;
        private $repass   = null;

        private $error    = null;

        function __construct($name, $mail, $username, $password, $repass) {
            $this->setDetails($name, $mail, $username, $password, $repass);
        }

        function setDetails($name, $mail, $username, $password, $repass) {
            $this->username = $username;
            $this->password = $password;
            $this->name = $name;
            $this->mail = $mail;
            $this->repass = $repass;
        }

        private function isEmpty() {
            if($this->username == "") {
                $this->setError("O username não é valido!");
                return true;
            }
            if($this->password == "") {
                $this->setError("A password não é valida!");
                return true;
            }
            if($this->name == "") {
                $this->setError("O nome não é valido!");
                return true;
            }
            if($this->mail == "") {
                $this->setError("O mail não é valido!");
                return true;
            }
            return false;
        }

        private function setError($msg) {
            $this->error = $msg;
        }

        public function getError() {
            return $this->error;
        }

        public function isRegistrationSuccessful() {
            if($this->isEmpty()) {
                return false;
            }

            if($this->repass != $this->password) {
                // Pass no match
                $this->setError("As passwords não coincidem!");
                return false;
            }

            if(UserUtils::Exists($this->username)) {
                $this->setError("O utilizador já existe!");
                return false;
            }
            return true;
        }
    }
?>