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

    public function enviarDados($id, $titulo, $categoria, $tipo, $empresa, $local, $descricao) {
        $this->pdo->query("INSERT INTO vagas (conta, titulo, categoria, tipo, empresa, local, descricao) VALUES ('$id', '$titulo', '$categoria', '$tipo', '$empresa', '$local', '$descricao')");
    }
    
}