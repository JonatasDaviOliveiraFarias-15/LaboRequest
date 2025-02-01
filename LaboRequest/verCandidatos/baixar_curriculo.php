<?php
session_start();
require_once 'funcoes.php';

$u = new funcoes("postgres", "aws-0-sa-east-1.pooler.supabase.com", "postgres.hnowsaozbepfcpznrywi", "vtRowbRnusY6BlOS", "6543");
$id = $_SESSION['id'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $u->baixarCurriculo($id);  
}

?>
