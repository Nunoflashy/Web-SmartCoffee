<?php
    class UserDatabase {
        function __construct(string $name) {

        }
        
        function addUser(User $user) {
            $conn = mysqli_connect($this->serverName, $this->username, $this->password);
            $db   = mysqli_select_db($conn, $databaseName);

            $hash = sha1($user->getPass());
            mysqli_query($conn, "INSERT INTO users(username, password, mail) VALUES()

        }

        $serverName     = "localhost";
        $username       = "root";
        $password       = "";
        $databaseName   = "SmartCoffee";
    }
?>