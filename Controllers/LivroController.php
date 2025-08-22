<?php
require_once __DIR__ . '/../Models/LivroModel.php';

class LivroController {
    private $model;

    public function __construct($db) {
        $this->model = new LivroModel($db);
    }

    public function cadastrarLivro($dados) {
        return $this->model->cadastrar(
            $dados['nome'],
            $dados['categoria'],
            $dados['custo_aluguel'],
            $dados['dias_emprestimo']
        );
    }

    public function buscarLivros($filtros) {
        return $this->model->buscar(
            $filtros['categoria'] ?? null,
            $filtros['precoMax'] ?? null,
            $filtros['ordenar'] ?? "recentes"
        );
    }
}