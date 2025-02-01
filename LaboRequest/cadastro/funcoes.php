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

    
    public function cadastro($nome, $email, $senha, $cpf, $tipo_conta){
        $cmd=$this->pdo->query("SELECT id FROM contas WHERE email = '$email'");
        if( $cmd->rowCount() > 0){
        return false;
    }
        else{$this->pdo-> query("INSERT INTO contas (nome, email, senha, cpf, tipo_conta) VALUES ('$nome', '$email', '$senha', '$cpf', '$tipo_conta')");
        return true; }
    }
}