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
    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $genero = addslashes($_POST['genero']);
        $ano_nascimento = addslashes($_POST['ano_nascimento']);
        $telefone = addslashes($_POST['telefone']);
        $celular = addslashes($_POST['celular']);
        $cursos = addslashes($_POST['cursos']);
        $idiomas = addslashes($_POST['idiomas']);
        $competencias = addslashes($_POST['competencias']);
        $formacao_academica = addslashes($_POST['formacao_academica']);
        $experiencias = addslashes($_POST['experiencias']);

        $u->enviarDados($id, $nome, $email, $genero, $ano_nascimento, $telefone, $celular, $cursos, $idiomas, $competencias, $formacao_academica, $experiencias);
        
        if (!empty($_FILES['curriculo']['name'])) {
    $diretorio = "uploads/curriculos/"; 

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $extensao = pathinfo($_FILES['curriculo']['name'], PATHINFO_EXTENSION);
    $nomeArquivo = "curriculo_" . $id . "." . $extensao;
    $caminhoArquivo = $diretorio . $nomeArquivo;

    if (move_uploaded_file($_FILES['curriculo']['tmp_name'], $caminhoArquivo)) {
        $u->atualizarCurriculo($id, $caminhoArquivo);
    } else {
        echo "Erro ao fazer upload do currículo.";
    }
}

if (!empty($_FILES['foto']['name'])) {
    $diretorio = "uploads/fotos/"; 

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $nomeArquivo = "foto_" . $id . "." . $extensao;
    $caminhoArquivo = $diretorio . $nomeArquivo;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoArquivo)) {
        $u->atualizarFoto($id, $caminhoArquivo);
    } else {
        echo "Erro ao fazer upload da foto.";
    }
}

    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$nascimento = $u->buscarNascimento($id);
$telefone = $u->buscarTelefone($id);
$celular = $u->buscarCelular($id);
$cr = $u->buscarCR($id);
$dc = $u->buscarDC($id);
$fa = $u->buscarFA($id);
$if = $u->buscarIF($id);
$experiencias = $u->buscarExperiencias($id);
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
        <div class="logo"><a href="../principal.php"><img src="../logo2.png" alt="Logo2" width="40px" height="40px"><img src="../logo.png" alt="Logo"></a></div>
        <div class="user-menu">
            <?php $foto = $u->buscarFoto($id);  // Supondo que a função buscarFoto retorna o caminho da foto no banco de dados
if ($foto) {
    echo '<img src="' . htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') . '" alt="Foto de Perfil" width="100" height="100" style="border-radius: 50%;">';
} else {
    echo '<img src="uploads/fotos/default.jpg" alt="Foto de Perfil" width="100" height="100" style="border-radius: 50%;">';  // Exibe uma imagem padrão caso não haja foto
}

?>

        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <nav class="menu">
                <table>
                    <tr>
                        <td><img src="perfilIcon.png" width="16px" height="16px"></td><td><a href="#perfil">Perfil</a></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><img src="formacaoIcon.png" width="16px" height="16px"></td><td><a href="#formacao">Formação Acadêmica</a></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><img src="experienciaIcon.png" width="16px" height="16px"></td><td><a href="#experiencia">Experiência</a></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><img src="curriculoIcon.png" width="16px" height="16px"></td><td><a href="#curriculo">Currículo</a></td>
                    </tr>
                </table>
            </nav>
        </aside>

        <main class="main-content">
    <h1>Perfil</h1>
    <hr>
    <br>
    <form class="form" id="form" method="POST" enctype="multipart/form-data">
        <!-- Informações do Perfil -->
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome" 
                value="<?php echo htmlspecialchars($u->buscarNome($id) ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" 
                value="<?php echo htmlspecialchars($u->buscarEmail($id) ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="form-group">
            <label for="genero">Gênero</label>
            <select id="genero" name="genero">
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
                <option value="prefiro_nao_informar">Prefiro não informar</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ano-nascimento">Ano de Nascimento</label>
            <input type="number" id="ano-nascimento" name="ano_nascimento" placeholder="Ex: 1990" 
                value="<?php echo $nascimento ? htmlspecialchars($nascimento, ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" id="telefone" name="telefone" placeholder="Ex: (61) 1234-5678" 
                value="<?php echo $telefone ? htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" placeholder="Ex: (61) 91234-5678" 
                value="<?php echo $celular ? htmlspecialchars($celular, ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>

        <h2 id="formacao">Formação Acadêmica</h2>
        <hr>
        <div class="form-group">
            <label for="cursos">Cursos Realizados</label>
            <textarea id="cursos" name="cursos" placeholder="Digite os cursos realizados"><?php echo $cr ? htmlspecialchars($cr, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="idiomas">Idiomas Falados</label>
            <textarea id="idiomas" name="idiomas" placeholder="Ex: Português, Inglês, Espanhol"><?php echo $if ? htmlspecialchars($if, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="competencias">Demais Competências</label>
            <textarea id="competencias" name="competencias" placeholder="Digite suas competências"><?php echo $dc ? htmlspecialchars($dc, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="formacao-academica">Formação Acadêmica</label>
            <textarea id="formacao-academica" name="formacao_academica" placeholder="Graduações, Pós-graduações, etc."><?php echo $fa ? htmlspecialchars($fa, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>

        <h2 id="experiencia">Experiência</h2>
        <hr>
        <div class="form-group">
            <label for="experiencias">Experiências</label>
            <textarea id="experiencias" name="experiencias" placeholder="Descreva suas experiências profissionais"><?php echo $experiencias ? htmlspecialchars($experiencias, ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>

        <h2 id="curriculo">Currículo</h2>
        <hr>
        <div class="form-group">
            <label for="curriculo">Anexar Currículo</label>
            <input type="file" id="curriculo" name="curriculo" accept=".pdf">
        </div>
        
        <h2 id="foto">Foto</h2>
        <hr>
        <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto" accept=".jpg, .png">
        </div>

        <button type="submit" class="btn-atualizar">Atualizar perfil</button>
    </form>
</main>

    </div>
</body>
</html>

    
