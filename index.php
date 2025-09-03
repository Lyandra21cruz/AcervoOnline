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
