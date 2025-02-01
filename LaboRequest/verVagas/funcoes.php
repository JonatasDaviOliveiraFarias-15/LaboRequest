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
    
    public function buscarTotalVagas($id) {
        $cmd=$this->pdo->query("SELECT COUNT(id_vaga) FROM candidaturas WHERE id_usuario='$id'");
        $trans=$cmd->fetch(PDO::FETCH_ASSOC);
        return $trans;
    }
    
    public function buscarInfoVagas() {
        $cmd=$this->pdo->query("SELECT * FROM vagas");
        $trans=$cmd->fetchAll(PDO::FETCH_ASSOC);
        return $trans;
    }
    
    public function validarCategoria($tipo){
        if($tipo=="bemEstar"){
            return "Bem-Estar";
        }
        elseif($tipo=="educacao"){
            return "Educação";
        }
        elseif($tipo=="tecnologia"){
            return "Tecnologia";
        }
        elseif($tipo=="saude"){
            return "Saúde";
        }
        elseif($tipo=="serEsp"){
            return "Serviçoes Especializados";
        }
        elseif($tipo=="outros"){
            return "Outros";
        }
    }
    
    public function validarTipo($tipo) {
        if($tipo=="presencial"){
            return "Presencial";
        }
        elseif($tipo=="remoto"){
            return "Remoto";
        }
        elseif($tipo=="hibrido"){
            return "Híbrido";
        }
    }
    
    public function candidatarVaga($idUsuario, $idVaga) {
        $this->pdo->query("INSERT INTO candidaturas (id_usuario, id_vaga) VALUES ('$idUsuario', '$idVaga')");
    }
    
    public function buscarCandidatura($id,$vagas) {
        $cmd= $this->pdo->query("SELECT id FROM candidaturas WHERE id_usuario='$id' AND id_vaga='$vagas'");
        if($cmd->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function verCandidaturas($id) {
        $cmd= $this->pdo->query("SELECT id_vaga FROM candidaturas WHERE id_usuario='$id'");
        $trans=$cmd->fetchAll(PDO::PARAM_STR);
        return $trans;
    }
    
    public function buscarVagas($id) {
        $cmd= $this->pdo->query("SELECT * FROM vagas WHERE id='$id'");
        $trans=$cmd->fetchAll(PDO::PARAM_STR);
        return $trans;
    }
}
