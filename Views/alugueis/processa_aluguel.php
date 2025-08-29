<?php
require_once "../../config/Database.php";
require_once "../../Controllers/AluguelController.php";

$database = new Database();
$db = $database->getConnection();

$controller = new AluguelController($db);

$idLivro = $_POST['id_livro'];
$idUsuario = $_POST['id_usuario'];
$diasEmprestimo = $_POST['dias_emprestimo'];

if ($controller->alugarLivro($idLivro, $idUsuario, $diasEmprestimo)) {
    echo "Livro alugado com sucesso!";
} else {
    echo "Erro ao alugar livro.";
}
