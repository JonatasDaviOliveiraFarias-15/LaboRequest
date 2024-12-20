<?php
require_once 'funcoes.php';
$u=new funcoes("sql10750543", "sql10.freesqldatabase.com", "sql10750543", "tGXF33BwST");
if(isset($_POST['nome'])){
    $nome= addslashes($_POST['nome']);
    $email= addslashes($_POST['email']);
    $senha= addslashes($_POST['senha']);
    $conf_Senha= addslashes($_POST['conf_Senha']);
    $tipo_conta= addslashes($_POST['tipo_conta']);
    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($conf_Senha)&&!empty($tipo_conta)){
        if($senha==$conf_Senha){
            if(!$u->cadastro($nome, $email, $senha)){
                ?>
                    <div class="texto">Email já cadastrado!</div>
                <?php
            }
        }
        else{
            ?>
                    <div class="texto">As duas senhas não conferem, tente novamente!</div>
            <?php
        }
    }
    else{
        ?>
        <div class="texto">Preencha todos os campos!</div>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastro de Conta</h2>
    <form action="cadastro.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Criar Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required><br><br>

        <label for="tipo_conta">Tipo de Conta:</label>
        <select id="tipo_conta" name="tipo_conta">
            <option value="fisica">Pessoa Física</option>
            <option value="juridica">Pessoa Jurídica</option>
        </select><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <p>Já tem uma conta? <a href="login.php">Clique aqui para fazer login</a></p>
</body>
</html>
