<?php
require_once __DIR__ . '/Controllers/UsuarioController.php';

$pagina = $_GET['pagina'] ?? 'login';
$controller = new UsuarioController();

if ($pagina === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login($_POST['email'], $_POST['senha']);
} elseif ($pagina === 'cadastrar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->cadastrar($_POST['nome'], $_POST['email'], $_POST['senha']);
} elseif ($pagina === 'recuperar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->recuperar($_POST['email'], $_POST['novaSenha'], $_POST['confirmarSenha']);
} elseif ($pagina === 'dashboard') {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?pagina=login");
        exit;
    }
    header("Location: Views/usuario/dashboard.php");
} else {
    include __DIR__ . "/Views/usuario/{$pagina}.php";
}
