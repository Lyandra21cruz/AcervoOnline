<?php
require_once __DIR__ . '/../Models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct($pdo) {
        $this->model = new UsuarioModel($pdo);
    }

    public function criar($nome, $email, $senha) {
        return $this->model->criar($nome, $email, $senha);
    }

    public function listar() {
        return $this->model->listar();
    }

    public function buscarPorId($id) {
        return $this->model->buscarPorId($id);
    }

    public function atualizar($id, $nome, $email, $senha = null) {
        return $this->model->atualizar($id, $nome, $email, $senha);
    }

    public function deletar($id) {
        return $this->model->deletar($id);
    }
}
