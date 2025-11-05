<?php
require_once __DIR__ . '/../Models/UsuarioModel.php';

class UsuarioController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }

public function cadastrar($nome, $email, $senha) {
    $resultado = $this->model->cadastrar($nome, $email, $senha);

    if ($resultado === true) {
        $perfil = $this->model->cadastrarPerfil($nome, $email);
        // Mesmo que já exista, continua o fluxo sem erro
        header("Location: index.php?pagina=login&msg=sucesso");
        exit;
    } elseif ($resultado === "email_duplicado") {
        header("Location: index.php?pagina=cadastro&erro=email_existente");
        exit;
    } else {
        echo "Erro ao cadastrar!";
    }
}

    public function login($email, $senha) {
        // Primeiro tenta login como Administrador
        $adm = $this->model->loginAdm($email, $senha);
        if ($adm) {
            session_start();
            $_SESSION['adm'] = $adm;
            header("Location: Views/adm/adm.php");
            exit;
        }

        // Se não for ADM, tenta login como Usuário
        $usuario = $this->model->login($email, $senha);
        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php?pagina=dashboard");
            exit;
        } else {
            header("Location: index.php?pagina=login&erro=1");
            exit;
        }
    }

    public function recuperar($email, $novaSenha, $confirmarSenha) {
        if ($novaSenha !== $confirmarSenha) {
            echo "As senhas não conferem!";
            return;
        }

        if ($this->model->recuperarSenha($email, $novaSenha)) {
            header("Location: index.php?pagina=login&msg=senha_alterada");
            exit;
        } else {
            echo "Erro ao recuperar senha!";
        }
    }
}
