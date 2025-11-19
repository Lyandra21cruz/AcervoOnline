<?php
session_start();
require_once "C:/Turma2/xampp/htdocs/AcervoOnline/config/conexao.php";

if (!isset($_SESSION['usuario']['id_usuario'])) {
    header("Location: ../../index.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

if (empty($_SESSION['carrinho'])) {
    die("Carrinho vazio.");
}

// salvar temporariamente o carrinho para etapa de pagamento
$_SESSION['pagamento_carrinho'] = $_SESSION['carrinho'];

// NÃO SALVAMOS NO BANCO AQUI — só depois da confirmação!

header("Location: pagamento.php");
exit;
?>
