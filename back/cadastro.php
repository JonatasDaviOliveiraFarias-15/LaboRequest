<?php
    require_once 'funcoes.php';
    $u=new funcoes("aula", "localhost", "root", "");
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloPaginaCadastro.css">
    <title>Cadastrar-se</title>
</head>
<body>
    <form id="login" method="POST">
        <input type="text" name="nome" id="nome" placeholder=" ">
        <label for="nome" id="nome-label">Nome</label>
        <br>
        <input type="email" name="email" id="email" placeholder=" ">
        <label for="email" id="email-label">E-mail</label>
        <br>
        <input type="password" name="senha" id="senha" placeholder=" ">
        <label for="password" id="password-label">Senha</label>
        <br>
        <input type="password" name="conf_Senha" id="conf_Senha" placeholder=" ">
        <label for="conf_password" id="conf_password-label">Confirmar Senha</label>
        <table>
            <tr>
                <td><input type="submit" name="submit" value="Criar conta">
                <td><a href="../Aulinha/index.php" target="_self">Entrar</a>
            </tr>
        </table>
    </form>
</body>