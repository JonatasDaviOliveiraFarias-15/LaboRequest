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
    
    public function cadastro($nome, $email, $senha, $tipo_conta){
        $cmd=$this->pdo->query("SELECT id FROM usuarios WHERE email = '$email'");
        if( $cmd->rowCount() > 0){
        return false;
    }
        else{this->pdo-> query("INSERT INTO usuarios (nome, email, senha, tipo_conta) VALUES ('$nome', '$email', '$senha', '$tipo_conta')");
        return true; }
    }
}