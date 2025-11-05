<?php
require_once "../../config/Database.php";
require_once "../../Controllers/LivroController.php";

$database = new Database();
$db = $database->getConnection();

$livroController = new LivroController($db);

// chama o método que busca os livros
$livros = $livroController->listarTodos();

// inclui a View
include "..Views/usuario/listar.php";
