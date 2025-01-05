<?php
session_start();
require 'funcoes.php';

$u = new funcoes("sql10750543", "sql10.freesqldatabase.com", "sql10750543", "tGXF33BwST");
if (!isset($_SESSION['id'])) {
    echo "<div class='errors'>Você precisa estar logado para acessar esta página.</div>";
    exit();
}

$usuario_id = $_SESSION['id']; 
$stmt = $u->pdo->query("SELECT * FROM usuarios WHERE id = '$usuario_id'");
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $genero = $_POST['genero'];
    $ano_nascimento = $_POST['ano_nascimento'];
    $telefone = trim($_POST['telefone']);
    $celular = trim($_POST['celular']);
    $cursos_realizados = trim($_POST['cursos']);
    $idiomas_falados = trim($_POST['idiomas']);
    $demais_competencias = trim($_POST['competencias']);
    $formacao_academica = trim($_POST['formacao_academica']);
    $experiencia = trim($_POST['experiencias']);

    if (empty($nome)) {
        echo "<div class='errors'>O nome é obrigatório.</div>";
        return;
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='errors'>E-mail inválido.</div>";
        return;
    }
    if (!in_array($genero, ['masculino', 'feminino', 'outro', 'prefiro_nao_informar'])) {
        echo "<div class='errors'>Gênero inválido.</div>";
        return;
    }

    $stmt = $u->pdo->query("UPDATE usuarios SET 
        nome = '$nome', email = '$email', genero = '$genero', ano_nascimento = '$ano_nascimento', telefone = '$telefone', celular = '$celular', 
        cursos_realizados = '$cursos_realizados', idiomas_falados = '$idiomas_falados', demais_competencias = '$demais_competencias', 
        formacao_academica = '$formacao_academica', experiencia = '$experiencia' WHERE id = '$usuario_id'");

    if ($stmt) {
        echo "<div class='success'>Dados atualizados com sucesso!</div>";
        $usuario = array_merge($usuario, $_POST);
    } else {
        echo "<div class='errors'>Erro ao atualizar os dados.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - LaboRequest</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
<header class="header">
        <div class="logo"><img src="../logo2.png" alt="Logo2" width="40px" height="40px"><img src="../logo.png" alt="Logo"></div>
        <nav class="nav">
            <a href="#">Explorar</a>
            <a href="#">Empregos em Destaque</a>
            <a href="#">Últimas vagas abertas</a>
            <a href="#">Minhas candidaturas</a>
            <a href="#">Novidades</a>
        </nav>
        <div class="user-menu">
            <button id="user-icon" class="user-icon">
                <img src="user-icon.png" alt="User Icon">
            </button>
            <div id="user-card" class="user-card hidden">
                <div class="card">
                    <img src="user-photo.png" alt="User Photo">
                    <h2><?= $usuario['nome'] ?? '' ?></h2>
                    <p><?= $usuario['email'] ?? '' ?></p>
                    <p><?= $usuario['telefone'] ?? '' ?></p>
                    <button>Compartilhar contato</button>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <main class="main-content">
            <h1>Perfil</h1>
            <hr>
            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $usuario['email'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="genero">Gênero</label>
                    <select id="genero" name="genero">
                        <option value="masculino" <?= ($usuario['genero'] ?? '') === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="feminino" <?= ($usuario['genero'] ?? '') === 'feminino' ? 'selected' : '' ?>>Feminino</option>
                        <option value="outro" <?= ($usuario['genero'] ?? '') === 'outro' ? 'selected' : '' ?>>Outro</option>
                        <option value="prefiro_nao_informar" <?= ($usuario['genero'] ?? '') === 'prefiro_nao_informar' ? 'selected' : '' ?>>Prefiro não informar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ano-nascimento">Ano de Nascimento</label>
                    <input type="number" id="ano-nascimento" name="ano_nascimento" value="<?= $usuario['ano_nascimento'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="<?= $usuario['telefone'] ?? '' ?>">
                </div>
                <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" value="<?= $usuario['celular'] ?? '' ?>">
                </div>

                <h2>Formação Acadêmica</h2>
                <hr>
                <div class="form-group">
                    <label for="cursos">Cursos Realizados</label>
                    <textarea id="cursos" name="cursos"><?= $usuario['cursos_realizados'] ?? '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="idiomas">Idiomas Falados</label>
                    <textarea id="idiomas" name="idiomas"><?= $usuario['idiomas_falados'] ?? '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="competencias">Demais Competências</label>
                    <textarea id="competencias" name="competencias"><?= $usuario['demais_competencias'] ?? '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="formacao-academica">Formação Acadêmica</label>
                    <textarea id="formacao-academica" name="formacao_academica"><?= $usuario['formacao_academica'] ?? '' ?></textarea>
                </div>

                <h2>Experiência</h2>
                <hr>
                <div class="form-group">
                    <label for="experiencias">Experiências</label>
                    <textarea id="experiencias" name="experiencias"><?= $usuario['experiencia'] ?? '' ?></textarea>
                </div>

                <button type="submit">Atualizar perfil</button>
            </form>
        </main>
    </div>
</body>
</html>
