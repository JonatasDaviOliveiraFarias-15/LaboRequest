<?php

class funcoes {
    private $pdo;
    
    public function __construct($dbname, $host, $user, $senha, $port=6543) {
     try {
            $dsn = "pgsql:host=" . $host . ";port=" . $port . ";dbname=" . $dbname;
            $this->pdo = new PDO($dsn, $user, $senha);
        } catch (PDOException $ex) {
        echo "Erro com banco de dados: " . $ex->getMessage();
        exit();
    }
}
    
    public function login($email,$senha){
        session_start();
        $cmd= $this->pdo->query("SELECT id FROM contas WHERE email='$email' AND senha='$senha'");
        if($cmd->rowCount()>0){
            $dado=$cmd->fetch();
            $_SESSION['id'] = $dado['id'];
            return true;
        }
        else{
            return false;
        }
    }
}