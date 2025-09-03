<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/Controllers/UsuarioController.php';
require_once __DIR__ . '/Views/UsuarioView.php';

// pega conexão pelo Database
$pdo = Database::getConnection();

$controller = new UsuarioController($pdo);
$view       = new UsuarioView();

// Exemplo: listar usuários
$usuarios = $controller->listar();
$view->mostrarLista($usuarios);

<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Início</title>
</head>
<body>
    <h1>Olá, <?php echo htmlspecialchars($usuario['nome']); ?>!</h1>
    <p>Você está logado com o e-mail: <?php echo htmlspecialchars($usuario['email']); ?></p>
    <p><a href="view/usuario/perfil.php">Ver perfil</a></p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
