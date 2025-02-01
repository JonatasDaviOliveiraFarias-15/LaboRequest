<?php
session_start();
require_once 'funcoes.php';
$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['foto'];

    // Define o nome do arquivo
    $nomeArquivo = time() . '_' . basename($arquivo['name']);
    $diretorioDestino = 'uploads/fotos/';
    $caminhoCompleto = $diretorioDestino . $nomeArquivo;

    // Criação da pasta caso não exista
    if (!is_dir($diretorioDestino)) {
        mkdir($diretorioDestino, 0777, true);
    }

    // Move o arquivo e atualiza a foto no banco
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
        $u->atualizarFoto($id, $caminhoCompleto);
        echo "Foto enviada com sucesso!";
    } else {
        echo "Erro ao enviar a foto. Verifique as permissões da pasta.";
    }
}


// Verificação de envio do currículo
if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['curriculo'];

    // Verifica se o arquivo é um PDF
    if (mime_content_type($arquivo['tmp_name']) === 'application/pdf') {
        $nomeArquivo = time() . '_' . basename($arquivo['name']);
        $diretorioDestino = 'uploads/curriculos/';
        $caminhoCompleto = $diretorioDestino . $nomeArquivo;

        // Criação da pasta caso não exista
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0777, true);
        }

        // Verificação se o arquivo foi movido corretamente
        if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
            $u->atualizarCurriculo($id, $caminhoCompleto);
            echo "Currículo enviado com sucesso!";
        } else {
            echo "Erro ao enviar o currículo. Verifique as permissões da pasta.";
        }
    } else {
        echo "O arquivo enviado não é um PDF.";
    }
}


header("Location: perfil.php?status=sucesso");
exit();
?>
