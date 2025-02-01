<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../login/login.php");
    exit();
}
require_once 'funcoes.php';
$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titulo'])) {
        $titulo = addslashes($_POST['titulo']);
        $categoria = addslashes($_POST['categoria']);
        $tipo = addslashes($_POST['tipo']);
        $empresa = addslashes($_POST['empresa']);
        $local = addslashes($_POST['local']);
        $descricao = addslashes($_POST['descricao']);
        $u->enviarDados($id, $titulo, $categoria, $tipo, $empresa, $local, $descricao);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Vaga - LaboRequest</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    <header class="header">
        <div class="logo"><a href="../principal.php"><img src="../logo2.png" alt="Logo2" width="40px" height="40px"><img src="../logo.png" alt="Logo"></a></div>
            <nav class="nav">
                <a href="../verCandidatos/verCandidatos.php">Minhas Vagas</a>
                <a href="">Adicionar Vagas</a>
                <a href="../perfil/perfil.php">Editar Perfil</a>
                <a href="../deslogar.php">Deslogar</a>
            </nav>
    </header>

    <div class="container">
        <main class="main-content">
            <h1>Características da Vaga</h1>
            <hr>
            <br>
            <form class="form" id="form" method="POST">
                <div class="form-group">
                    <label for="nome">Título</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Digite o título da vaga">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select id="categoria" name="categoria">
                        <option value="bemEstar">Bem-Estar</option>
                        <option value="educacao">Educação</option>
                        <option value="tecnologia">Tecnologia</option>
                        <option value="saude">Saúde</option>
                        <option value="serEsp">Serviçoes Especializados</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select id="tipo" name="tipo">
                        <option value="presencial">Presencial</option>
                        <option value="remoto">Remoto</option>
                        <option value="hibrido">Híbrido</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="celular">Empresa</label>
                    <input type="text" id="empresa" name="empresa" placeholder="Digite o nome da empresa que está ofertando a vaga">
                </div>
                <div class="form-group">
                    <label for="celular">Local</label>
                    <input type="text" id="local" name="local" placeholder="Digite o local onde a empresa está localizada/onde o serviço será feito">
                </div>
                <div class="form-group">
                    <label for="formacao-academica">Descrição da Vaga</label>
                    <textarea id="descricao" name="descricao" placeholder="Descreva brevemente a vaga contando com salário e período de trabalho"></textarea>
                </div>
                <button type="submit" class="btn-atualizar">Enviar Vaga</button>
            </form>
        </main>
    </div>
</body>
</html>

    
