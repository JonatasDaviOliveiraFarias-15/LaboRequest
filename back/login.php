<?php
    session_start();
    require_once 'funcoes.php';
    $u=new funcoes("sql10750543", "sql10.freesqldatabase.com", "sql10750543", "tGXF33BwST");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['senha'];

        $response_query = "SELECT id, nome, email, senha FROM contas WHERE username = ?";
        $smt = $pdo->prepare($response_query);
        $smt -> bind_param("s", $email)
        $smt -> execute();
        $smt -> store_result();
        if ($smt->num_rows > 0){
            $smt -> bind_result($id, $email, $user_password);
            $smt ->fetch();
            if ($password == $user_password){
                $_SESSION['email'] = $email;
                #RESTANTE
            } else {
                echo "Senha incorreta"
            }

        } else {
            echo "Não existe usuário com esse email."
        }

        $smt->close()
    }

    $pdo->close()

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
