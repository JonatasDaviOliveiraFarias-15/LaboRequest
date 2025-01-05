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
  <title>Cadastro</title>
  <link rel="stylesheet" href="estiloLogin.css">
</head>
<body>
    <div class="Frame2257">
      <div class="Frame2256">
            <div class="logo">
                <img src="logo2.png" alt="Logo2" width="45px" height="45px"><img src="logo.png" alt="Logo">
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
              <input type="checkbox" id="candidato">
              <label for="candidato" style="color:white;">Sou candidato</label>
            </div>
            <div>
              <input type="checkbox" id="usuario">
              <label for="usuario" style="color:white;">Sou Usuário</label>
            </div>
          </div>
        <div class="Frame5">
            <input type="submit" value="Entrar">
        </div>
        </form>
        <div class="ntc">Já tem uma conta? Faça <a href="">Login</a></div>
      </div>
    </div>
</body>
</html>
