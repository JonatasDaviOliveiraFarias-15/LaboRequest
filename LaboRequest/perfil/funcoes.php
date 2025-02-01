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
    private function buscarCampoContas($campo, $tabela, $id) {
        $cmd = $this->pdo->prepare("SELECT $campo FROM $tabela WHERE id = :id");
        $cmd->bindParam(':id', $id, PDO::PARAM_INT);
        $cmd->execute();
        $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
        return $resultado[$campo] ?? null;
    }
    
    private function buscarCampoPerfil($campo, $tabela, $id) {
        $cmd = $this->pdo->prepare("SELECT $campo FROM $tabela WHERE id_user = :id");
        $cmd->bindParam(':id', $id, PDO::PARAM_INT);
        $cmd->execute();
        $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
        return $resultado[$campo] ?? null;
    }

    public function buscarNome($id) {
        return $this->buscarCampoContas('nome', 'contas', $id);
    }

    public function buscarEmail($id) {
        return $this->buscarCampoContas('email', 'contas', $id);
    }

    public function buscarGenero($id) {
        return $this->buscarCampoPerfil('genero', 'perfil', $id);
    }

    public function buscarNascimento($id) {
        return $this->buscarCampoPerfil('nascimento', 'perfil', $id);
    }

    public function buscarTelefone($id) {
        return $this->buscarCampoPerfil('telefone', 'perfil', $id);
    }

    public function buscarCelular($id) {
        return $this->buscarCampoPerfil('celular', 'perfil', $id);
    }

    public function buscarCR($id) {
        return $this->buscarCampoPerfil('cr', 'perfil', $id);
    }

    public function buscarIF($id) {
        return $this->buscarCampoPerfil('if', 'perfil', $id);
    }

    public function buscarDC($id) {
        return $this->buscarCampoPerfil('dc', 'perfil', $id);
    }

    public function buscarFA($id) {
        return $this->buscarCampoPerfil('fa', 'perfil', $id);
    }

    public function buscarExperiencias($id) {
        return $this->buscarCampoPerfil('experiencias', 'perfil', $id);
    }
    
    public function enviarDados($id, $nome, $email, $genero, $ano_nascimento, $telefone, $celular, $cursos, $idiomas, $competencias, $formacao_academica, $experiencias) {
    $this->pdo->query("UPDATE perfil SET 
        genero='$genero',
        nascimento='$ano_nascimento',
        telefone='$telefone',
        celular='$celular',
        cr='$cursos',
        if='$idiomas',
        dc='$competencias',
        fa='$formacao_academica',
        experiencias='$experiencias'
        WHERE id_user='$id'");
    
    $this->pdo->query("UPDATE contas SET nome='$nome', email='$email' WHERE id='$id'");
    
    }
    
    public function atualizarFoto($id, $caminhoArquivo) {
    $sql = "UPDATE perfil SET foto = :foto WHERE id_user = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':foto', $caminhoArquivo, PDO::PARAM_STR);  // Atualiza o campo foto
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}


    public function atualizarCurriculo($id, $caminhoArquivo) {
    $sql = "UPDATE perfil SET curriculo = :curriculo WHERE id_user = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':curriculo', $caminhoArquivo, PDO::PARAM_STR);  // Atualiza o campo curriculo
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}


public function buscarFoto($id_usuario) {
    $sql = "SELECT foto FROM perfil WHERE id_user = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id_usuario);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result['foto'] ?? ''; // Retorna o caminho da foto, ou uma string vazia se não encontrar
}



}