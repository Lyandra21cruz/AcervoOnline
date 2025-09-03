<?php
require_once __DIR__ . '/../Models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

    public function cadastrar($nome, $email, $senha) {
        if ($this->model->cadastrar($nome, $email, $senha)) {
            header("Location: index.php?pagina=login&msg=sucesso");
            exit;
        } else {
            echo "Erro ao cadastrar!";
        }
    }

    public function login($email, $senha) {
    $usuario = $this->model->login($email, $senha);

    if ($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php?pagina=dashboard");
        exit;
    } else {
        // passa mensagem de erro de volta para view
        $erro = "E-mail ou senha incorretos!";
        include __DIR__ . '/../Views/usuario/login.php';
    }
}


    public function recuperar($email, $novaSenha) {
        if ($this->model->recuperarSenha($email, $novaSenha)) {
            header("Location: index.php?pagina=login&msg=senha_alterada");
            exit;
        } else {
            echo "Erro ao recuperar senha!";
        }
    }
}
