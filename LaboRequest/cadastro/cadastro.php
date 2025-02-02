<?php
require_once 'funcoes.php';
$u=new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="estiloCadastro.css">
</head>
<body>
    <div class="Frame2257">
      <div class="Frame2256">
            <div class="logo">
              <a href="../index.php"><img src="../logo2.png" alt="Logo2" width="45px" height="45px"><img src="../logo.png" alt="Logo"></a>
            </div>
            <form id="cadastro" method="POST">
          <div class="Frame4">
            <div class="Frame1">
              <div class="email"><input type="email" placeholder="Email" name="email" id="email"></div>
            </div>
          </div>
          <div class="Frame4">
            <div class="Frame1">
              <div class="nome"><input type="text" placeholder="Nome Completo" name="nome" id="nome"></div>
            </div>
          </div>
          <div class="Frame4">
            <div class="Frame1">
              <div class="cpf"><input type="text" placeholder="CPF" name="cpf" id="cpf"></div>
            </div>
          </div>
          <div class="Frame3">
            <div class="Frame2">
              <div class="senha"><input type="password" placeholder="Senha" name="senha" id="senha"></div>
            </div>
          </div>
          <div class="Frame3">
            <div class="Frame2">
              <div class="senha"><input type="password" placeholder="Confirmar Senha" name="conf_senha" id="conf_senha"></div>
            </div>
          </div>
          <div style="display: flex; gap: 10px; align-items: center;">
            <div>
              <input type="checkbox" id="candidato" value="1" name="val[]">
              <label for="candidato" style="color:white;">Sou candidato</label>
            </div>
            <div>
              <input type="checkbox" id="empresa" value="2" name="val[]">
              <label for="usuario" style="color:white;">Sou Empresa</label>
            </div>
          </div>
        <div class="Frame5">
            <input type="submit" value="Criar Conta">
        </div>
        </form>
        <div class="ntc">Já tem uma conta? Faça <a href="../login/login.php">Login</a></div>
      </div>
    </div>
</body>
</html>
<?php
    $dados_cadastro= filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if(isset($_POST['nome'])){
        $nome= addslashes($_POST['nome']);
        $email= addslashes($_POST['email']);
        $cpf = addslashes($_POST['cpf']);
        $senha= addslashes($_POST['senha']);
        $conf_senha= addslashes($_POST['conf_senha']);
        $tipo_conta = $_POST['val'] ?? [];
        if (!empty($nome) && !empty($email) && !empty($cpf) && !empty($senha) && !empty($conf_senha) && !empty($tipo_conta)) {
        if (count($tipo_conta) === 1) { // Certifique-se de que apenas um foi selecionado
            $tipo_conta = $tipo_conta[0]; // Pega o valor do único checkbox selecionado
            if ($senha === $conf_senha) {
                if (!$u->cadastro($nome, $email, $senha, $cpf, $tipo_conta)) {
                    echo '<div class="texto">Email já cadastrado!</div>';
                }
            } else {
                echo '<div class="texto">As duas senhas não conferem, tente novamente!</div>';
            }
        } else {
            echo '<div class="texto">Selecione apenas um tipo de conta!</div>';
        }
    } else {
        echo '<div class="texto">Preencha todos os campos!</div>';
    }
    }
?>
