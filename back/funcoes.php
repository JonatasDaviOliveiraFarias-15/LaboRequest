<?php

class funcoes {
    private $pdo;
    
    public function __construct($dbname,$host,$user,$senha) {
        try{
            $this->pdo=new PDO("mysql:dbname=".$dbname.";host:".$host,$user,$senha);
        } catch (PDOException $ex) {
            echo "Erro com banco de dados ".$ex->getMessage();
            exit();
        }
    }
}
