<?php
require_once __DIR__ . '/../Models/AluguelModel.php';

class AluguelController {
    private $model;
    public $db;

    public function __construct($db) {
        $this->model = new AluguelModel();
    }

    public function alugarLivro($idLivro, $idUsuario, $diasEmprestimo) {
        return $this->model->alugarLivro($idLivro, $idUsuario, $diasEmprestimo);
    }

    public function listarAlugados() {
        return $this->model->listarAlugados();
    }
}
