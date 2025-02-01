<?php
    require_once 'funcoes.php';
    $u=new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="estiloLogin.css">
</head>
<body>
    <div class="Frame2257">
      <div class="Frame2256">
            <div class="logo">
              <a href="../index.php"><img src="../logo2.png" alt="Logo2" width="45px" height="45px"><img src="../logo.png" alt="Logo"></a>
            </div>
          <form id="login" method="POST">
            <div class="Frame4">
                <div class="Frame1">
                    <div class="email"><input type="email" placeholder="Email" id="email" name="email"></div>
                </div>
            </div>
            <div class="Frame3">
                <div class="Frame2">
                    <div class="senha"><input type="password" placeholder="Senha" id="senha" name="senha"></div>
                </div>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;"></div>
            <div class="Frame5">
                <input type="submit" value="Entrar">
            </div>
          </form>
        <div class="ntc">Ainda não tem uma conta? <a href="../cadastro/cadastro.php">Cadastre-se</a></div>
      </div>
    </div>
    <?php
    if(isset($_POST['email'])){
        $email= addslashes($_POST['email']);
        print_r($email);
        $senha= addslashes($_POST['senha']);
        
        if(!empty($email) && !empty($senha)){
            if($u->login($email, $senha)){
                    header("location: ../principal.php");
                    exit();
            }
            else{
                ?>
                    <div class="texto" style="color: white;">Email e/ou senha incorretos!</div>
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
</body>
</html>
