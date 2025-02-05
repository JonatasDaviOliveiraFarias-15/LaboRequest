<?php
session_start();

require_once 'funcoes.php';
$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];

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
    <link rel="stylesheet" href="estiloVerCandidatos.css">
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
            <a href="">Ver Candidatos</a>
            <a href="../cadastroVagas/cadastroVagas.php">Adicionar Vagas</a>
            <a href="../perfil/perfil.php">Editar Perfil</a>
            <a href="../deslogar.php">Deslogar</a>
        </nav>
    </header>

    <form id="enviar" method="POST">
        <select id="mostra" name="mostra">
            <?php
            $dados = $u->buscarDadosCandidatos($id);
            foreach ($dados as $o) {
                $selected = (isset($_POST['mostra']) && $_POST['mostra'] == $o['id']) ? 'selected' : '';
            ?>
                <option value="<?php echo $o['id']; ?>" <?php echo $selected; ?>> <?php echo $o['titulo']; ?> </option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Selecionar">
    </form>

    <?php 
    if (isset($_POST['mostra'])) {
        $vagaSelecionada = null;
        
        foreach ($dados as $vaga) {
            if ($vaga['id'] == $_POST['mostra']) {
                $vagaSelecionada = $vaga['titulo'];
                break;
            }
        }

        if ($vagaSelecionada) {
            echo "<div class='titulo-container'><h2 class='titulo-vaga'>Vaga Selecionada: " . htmlspecialchars($vagaSelecionada) . "</h2></div>";
        }

        $ver = $u->verCandidaturas($_POST['mostra']);  
    ?>
    <div class="job-list">
        <?php
        foreach ($ver as $value) { 
            $vaga = $u->buscarPessoas($value["id_usuario"]); 
            $pes = $u->buscarNomeEmail($value["id_usuario"]);

            if (!empty($vaga)) {
        ?>
            <form class="job-card-form" method="POST">
                <div class="job-card">
                    <h3>Nome: <?php echo htmlspecialchars($pes[0]['nome']); ?></h3>
                    <p>E-mail: <?php echo htmlspecialchars($pes[0]['email']); ?></p>
                    <p>Gênero: <?php echo htmlspecialchars($vaga[0]['genero']); ?></p>
                    <p>Ano de Nascimento: <?php echo htmlspecialchars($vaga[0]['nascimento']); ?></p>
                    <p>Telefone: <?php echo htmlspecialchars($vaga[0]['telefone']); ?></p>
                    <p>Celular: <?php echo htmlspecialchars($vaga[0]['celular']); ?></p>
                    <p>Cursos Realizados: <?php echo htmlspecialchars($vaga[0]['cr']); ?></p>
                    <p>Idiomas Falados: <?php echo htmlspecialchars($vaga[0]['if']); ?></p>
                    <p>Demais Competências: <?php echo htmlspecialchars($vaga[0]['dc']); ?></p>
                    <p>Formação Acadêmica: <?php echo htmlspecialchars($vaga[0]['fa']); ?></p>
                    <p>Experiências: <?php echo htmlspecialchars($vaga[0]['experiencias']); ?></p>

                    <a href="baixar_curriculo.php?id=<?php echo $value['id_usuario']; ?>" class="btn-download">Baixar Currículo</a>
                </div>
            </form>
        <?php
            } else {
                echo "<p>Nenhum candidato encontrado.</p>";
            }
        }
        ?>
    </div>
    <?php } ?>

</body>
</html>
