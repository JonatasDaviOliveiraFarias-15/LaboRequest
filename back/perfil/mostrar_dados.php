<?php
    session_start();
    require_once 'funcoes.php';
    $u=new funcoes("sql10750543", "sql10.freesqldatabase.com", "sql10750543", "tGXF33BwST");

    session_start();
    if (!isset($_SESSION['id'])) {
        die("Usuário não autenticado. Faça login para continuar.");
    }
    $userId = $_SESSION['id'];

    try {
    
        $stmt = $u->pdo->query("SELECT salario, beneficios, periodos_trabalho FROM usuarios WHERE WHERE id = '$userId'");
    
        if ($stmt->rowCount() > 0) {
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $salario = $userData['salario'];
            $beneficios = $userData['beneficios'];
            $periodos_trabalho = $userData['periodos_trabalho'];
        } else {
            echo "<div class='errors'>Usuário não encontrado</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='errors'>Erro na busca</div>";
    }
    ?>