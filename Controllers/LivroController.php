<?php
require_once __DIR__ . '/../Models/LivroModel.php';

class LivroController {
    private $model;

    public function __construct($db) {
        $this->model = new Livro($db);
    }

    public function listarTodos() {
        return $this->model->listar();
    }

    public function cadastrarLivro($dados) {
        try {
            // Garantir que o PDF está marcado corretamente
            $dados['possui_pdf'] = !empty($dados['possui_pdf']) ? 'SIM' : 'NAO';

            // Aqui NÃO fazemos novo upload — já foi feito em processa_cadastro.php
            // O campo $dados['arquivo_pdf'] já contém o nome do arquivo (ou null)
            // Apenas chamamos o model
            return $this->model->cadastrar($dados);

        } catch (Exception $e) {
            error_log("Erro ao cadastrar livro: " . $e->getMessage());
            return false;
        }
    }
}
