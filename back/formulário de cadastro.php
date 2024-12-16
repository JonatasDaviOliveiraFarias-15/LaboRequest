<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $tipo_conta = $_POST['tipo_conta'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem!";
    } else {
        // Verificar se o email já está cadastrado
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Este email já está cadastrado.";
        } else {
            // Criar senha hash
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Inserir no banco de dados
            $sql = "INSERT INTO usuarios (nome, email, senha, tipo_conta) VALUES ('$nome', '$email', '$senha_hash', '$tipo_conta')";

            if ($conn->query($sql) === TRUE) {
                // Redirecionar para a página de login após o cadastro
                header("Location: login.php");
                exit();
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }
    }
}

$conn->close();
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
