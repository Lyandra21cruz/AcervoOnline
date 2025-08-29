<?php
require_once __DIR__ . '/../config/Database.php';

class AluguelModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Inserir novo aluguel
    public function alugarLivro($idLivro, $idUsuario, $diasEmprestimo) {
        $dataAluguel = date('Y-m-d H:i:s');
        $dataDevolucao = date('Y-m-d H:i:s', strtotime("+$diasEmprestimo days"));

        $sql = "INSERT INTO livros_alugados 
                   (id_livro, id_usuario, data_aluguel, dias_emprestimo, data_devolucao, devolvido, multa) 
                VALUES 
                   (:id_livro, :id_usuario, :data_aluguel, :dias_emprestimo, :data_devolucao, 'NAO', 0.00)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_livro', $idLivro);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':data_aluguel', $dataAluguel);
        $stmt->bindParam(':dias_emprestimo', $diasEmprestimo);
        $stmt->bindParam(':data_devolucao', $dataDevolucao);

        return $stmt->execute();
    }

    // Listar livros alugados
    public function listarAlugados() {
        $sql = "SELECT a.id, l.titulo, l.autor, a.data_aluguel, a.data_devolucao, a.devolvido,
                       CASE 
                         WHEN a.data_devolucao < NOW() AND a.devolvido = 'NAO' THEN 'ATRASADO'
                         WHEN DATE(a.data_devolucao) = CURDATE() THEN 'VENCE HOJE'
                         ELSE 'NO PRAZO'
                       END as status
                FROM livros_alugados a
                JOIN livros l ON a.id_livro = l.id_livro";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
