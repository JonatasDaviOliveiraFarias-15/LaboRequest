<?php
session_start();

require_once 'funcoes.php';
$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];
$ver = $u->verCandidaturas($id); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['vaga'])) {
        $vagas = $_POST['vaga'];

        foreach ($vagas as $vagaId) {
            $u->candidatarVaga($id, $vagaId);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Vagas - LaboRequest</title>
    <link rel="stylesheet" href="estiloVerVagas.css">
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
            <a href="">Minhas Vagas</a>
            <a href="../pesquisa/pesquisa.php">Encontrar Trabalhos</a>
            <a href="../perfil/perfil.php">Editar Perfil</a>
            <a href="../deslogar.php">Deslogar</a>
        </nav>
    </header>

    <div class="job-list">
        <?php
        foreach ($ver as $value) { 
            $vaga = $u->buscarVagas($value["id_vaga"]); 
        ?>
        <form class="job-card-form" method="POST">
            <div class="job-card">
                <h3><?php echo $vaga[0]['titulo']; ?></h3>
                <p><?php echo $vaga[0]['empresa']; ?> - <?php echo $vaga[0]['local']; ?></p>
                <p><?php echo $vaga[0]['descricao']; ?></p>
                <div class="tags">
                    <span class="presencial"><?php echo $u->validarTipo($vaga[0]['tipo']); ?></span>
                    <span><?php echo $u->validarCategoria($vaga[0]['categoria']); ?></span>
                </div>
                <span class="status">Inscrito</span>
            </div>
        </form>
        <?php } ?>
    </div>
</body>
</html>
