<?php
session_start();
require_once 'funcoes.php';

$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];

$pesquisa = '';
$categorias = [];
$resultado = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesquisa = $_POST['pesquisa'] ?? '';
    $categorias = isset($_POST['categorias']) ? $_POST['categorias'] : [];

    if (in_array("", $categorias)) {
        $categorias = [];
    }

    $resultado = $u->buscaVagas($pesquisa, $categorias);
} else {
    $resultado = $u->buscarInfoVagas();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Vagas - LaboRequest</title>
    <link rel="stylesheet" href="estiloPesquisa.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="../principal.php">
                <img src="../logo2.png" alt="Logo2" width="40px" height="40px">
                <img src="../logo.png" alt="Logo">
            </a>
        </div>
        <nav class="nav">
            <a href="../verVagas/verVagas.php">Minhas Vagas</a>
            <a href="">Encontrar Trabalhos</a>
            <a href="../perfil/perfil.php">Editar Perfil</a>
            <a href="../deslogar.php">Deslogar</a>
        </nav>
    </header>

    <form method="POST" class="search-form">
        <div class="search-bar">
            <input type="text" placeholder="Título da vaga ou palavra-chave" name="pesquisa" value="<?= htmlspecialchars($pesquisa) ?>">
            <select name="categorias[]" class="category-select">
                <option value="">Todas as Categorias</option>
                <option value="bemEstar" <?= in_array("bemEstar", $categorias) ? "selected" : "" ?>>Bem-Estar</option>
                <option value="educacao" <?= in_array("educacao", $categorias) ? "selected" : "" ?>>Educação</option>
                <option value="tecnologia" <?= in_array("tecnologia", $categorias) ? "selected" : "" ?>>Tecnologia</option>
                <option value="saude" <?= in_array("saude", $categorias) ? "selected" : "" ?>>Saúde</option>
                <option value="serEsp" <?= in_array("serEsp", $categorias) ? "selected" : "" ?>>Serviços Especializados</option>
                <option value="outros" <?= in_array("outros", $categorias) ? "selected" : "" ?>>Outros</option>
            </select>
            <button type="submit">Procurar</button>
        </div>
    </form>

    <div class="job-list">
        <?php foreach ($resultado as $value): ?>
            <form class="job-card-form" method="POST">
                <div class="job-card">
                    <h3><?= htmlspecialchars($value['titulo']) ?></h3>
                    <p><?= htmlspecialchars($value['empresa']) ?> - <?= htmlspecialchars($value['local']) ?></p>
                    <p><?= htmlspecialchars($value['descricao']) ?></p>
                    <div class="tags">
                        <span class="presencial"><?= $u->validarTipo($value['tipo']) ?></span>
                        <span><?= $u->validarCategoria($value['categoria']) ?></span>
                    </div>
                    <?php if ($u->buscarCandidatura($id, $value['id'])): ?>
                        <p>Inscrito</p>
                    <?php else: ?>
                        <button type="submit" name="vaga[]" value="<?= $value['id'] ?>" class="apply-button">Candidate-se</button>
                    <?php endif; ?>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>
