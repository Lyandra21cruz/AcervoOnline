<?php
class Livro {
    private $conn;
    private $table_name = "livros";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cadastrar($dados) {
        try {
            $query = "INSERT INTO {$this->table_name} 
                (titulo, autor, categoria, sinopse, custo_aluguel, imagem, possui_pdf, arquivo_pdf)
                VALUES (:titulo, :autor, :categoria, :sinopse, :custo_aluguel, :imagem, :possui_pdf, :arquivo_pdf)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":titulo", $dados['titulo']);
            $stmt->bindParam(":autor", $dados['autor']);
            $stmt->bindParam(":categoria", $dados['categoria']);
            $stmt->bindParam(":sinopse", $dados['sinopse']);
            $stmt->bindParam(":custo_aluguel", $dados['custo_aluguel']);
            $stmt->bindParam(":imagem", $dados['imagem']);
            $stmt->bindParam(":possui_pdf", $dados['possui_pdf']);
            $stmt->bindParam(":arquivo_pdf", $dados['arquivo_pdf']);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Erro no Model Livro: " . $e->getMessage());
            return false;
        }
    }

    public function listar() {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
