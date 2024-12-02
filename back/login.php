<?php
    require_once 'funcoes.php';
    $u=new funcoes("aula", "localhost", "root", "");
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
