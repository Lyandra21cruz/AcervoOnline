<?php
require_once __DIR__ . '/../Models/LivroModel.php';
class LivroController {
    private $model;

    public function __construct($db) {
        $this->model = new Livro($db);
    }

    public function listarTodos() {
    return $this->model->listar(); // retorna um array com todos os livros
}

    public function cadastrarLivro($dados) {
        return $this->model->cadastrar($dados);
    }
}