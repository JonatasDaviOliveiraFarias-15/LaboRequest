<?php
    session_start();
    require_once 'funcoes.php';
    $u=new funcoes("sql10750543", "sql10.freesqldatabase.com", "sql10750543", "tGXF33BwST");

    if(isset($_POST['email'])){
        $email= addslashes($_POST['email']);
        $senha= addslashes($_POST['senha']);
        
        if(!empty($email) && !empty($senha)){
            if($u->login($email, $senha)){
                    header("location: ");
                    exit();
            }
            else{
                ?>
                    <div class="texto">Email e/ou senha incorretos!</div>
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
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form id="login" method="POST">
            <input type="email" name="email" placeholder=" ">
            <label for="email" id="email-label">E-mail</label>
            <br>
            <input type="password" name="senha" placeholder=" ">
            <label for="senha" id="senha-label">Senha</label>
            <br>
            <button>Entrar</button>
            <a href="" target="_self" class="cadastro">Criar conta</a>
        </form>
    </body>
</html>
