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

    public function buscarTipoConta($id) {
        $cmd= $this->pdo->query("SELECT tipo_conta FROM contas WHERE id='$id'");
        $trans=$cmd->fetch(PDO::FETCH_ASSOC);
        return $trans['tipo_conta'];
    }
    
    public function buscarQuantidadeVagas($categoria) {
        $cmd=$this->pdo->query("SELECT COUNT(id) FROM vagas WHERE categoria='$categoria'");
        $trans=$cmd->fetch(PDO::FETCH_ASSOC);
        return $trans;
    }
}
