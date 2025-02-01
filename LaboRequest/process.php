<?php
$host = "aws-0-sa-east-1.pooler.supabase.com";
$port = "6543";
$dbname = "postgres";
$user = "postgres.hnowsaozbepfcpznrywi";  
$password = "vtRowbRnusY6BlOS";  

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  

        $sql = "INSERT INTO contas (nome, email, senha) VALUES (:nome, :email, :senha)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();

        echo "Cadastro realizado com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro na conexão ou inserção: " . $e->getMessage();
}
?>
