<?php
require_once 'funcoes.php';

function buscarVagasPorCategoria($categoria) {
    try 
        $db = new funcoes('nome_do_banco', 'localhost', 'usuario', 'senha')
        $pdo = $db->pdo;
        $sql = "SELECT nome_vaga, salario, beneficios, periodo FROM vagas WHERE categoria = '$categoria'";
        $stmt = $pdo->query($sql);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    } catch (PDOException $e) {
        die("Erro ao conectar ou executar consulta no banco de dados: " . $e->getMessage());
    }
}