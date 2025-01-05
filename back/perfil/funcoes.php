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
    
    public function login($email, $senha) {
        session_start();
        $cmd = $this->pdo->query("SELECT id FROM usuarios WHERE email = '$email' AND senha='$senha'");
        if( $cmd->rowCount() > 0){
            $dado = $cmd->fetch(PDO::FETCH_ASSOC);
            $_SESSION["id"] = $dado["id"];
            return true;
        }    
    }
}