<?php
class UsuarioModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Criar usuário
    public function criar($nome, $email, $senha) {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }

    // Listar todos os usuários
    public function listar() {
        $sql = "SELECT id_usuario, nome, email FROM usuarios";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar por ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar
    public function atualizar($id, $nome, $email, $senha = null) {
        if ($senha) {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            return $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':id' => $id
            ]);
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id_usuario = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':id' => $id
            ]);
        }
    }

    // Deletar
    public function deletar($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
