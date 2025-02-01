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
    
    public function verCandidaturas($id) {
    $cmd = $this->pdo->query("SELECT id_usuario FROM candidaturas WHERE id_vaga='$id'");
    $trans = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $trans;
}

public function buscarPessoas($id) {
    $cmd = $this->pdo->query("SELECT * FROM perfil WHERE id_user='$id'");
    $trans = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $trans;
}

    
    public function buscarDadosCandidatos($id) {
        $valores=$this->pdo->query("SELECT id, titulo FROM vagas WHERE conta='$id'");
        $materias=$valores->fetchAll(PDO::FETCH_ASSOC);
        return $materias;
    }
    
    public function buscarNomeEmail($id) {
    $cmd = $this->pdo->query("SELECT nome, email FROM contas WHERE id='$id'");
    $trans = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $trans;
}

    public function baixarCurriculo($id) {
    $diretorio = $_SERVER['DOCUMENT_ROOT'] . '/LaboRequest/perfil/';  

    $sql = "SELECT curriculo FROM perfil WHERE id_user = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['curriculo'])) {
        $caminhoArquivo = $diretorio . $result['curriculo'];  

        // Verificar se o arquivo existe
        if (file_exists($caminhoArquivo)) {
            // Forçar o download do arquivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($caminhoArquivo) . '"');
            header('Content-Length: ' . filesize($caminhoArquivo));
            readfile($caminhoArquivo);
            exit;
        } else {
            echo "Arquivo não encontrado no diretório!";
        }
    } else {
        echo "Currículo não encontrado no banco de dados!";
    }
}






}
