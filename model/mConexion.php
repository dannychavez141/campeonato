<?php

class mConexion {
/*
    private $host = "179.61.12.105";
    private $user = "premiumc_premium";
   private $pass = "Losloles54";
   private $database = "premiumc_pcoll";
   private $bd;*/
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $database = "campeonatos";
    private $bd;

    function __construct() {
        $this->bd = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if (mysqli_connect_errno($this->bd)) {
            echo '{"error":{"text" : "' . mysqli_connect_error($this->bd) . "}}";
            exit();
        };
    }

    public function getBd() {
        return $this->bd;
    }

    public function setBd($bd): void {
        $this->bd = $bd;
    }

}
