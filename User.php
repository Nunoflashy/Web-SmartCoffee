<?php

class User {
    function __construct($name, $pass, $mail) {
        $this->name = $name;
        $this->pass = $pass;
        $this->mail = $mail;
    }

    function setName($n) {
        $this->name = $n;
    }

    function setPassword($p) {
        $this->pass = $p;
    }

    function setMail($m) {
        $this->mail = $m;
    }

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->pass;
    }

    function getMail() {
        return $this->mail;
    }

    private string $name = null;
    private string $pass = null;
    private string $mail = null;
    
};

?>