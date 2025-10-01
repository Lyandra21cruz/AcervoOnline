<?php
require_once __DIR__ . "/../config/conexao.php";

class Livro {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function listar() {
    $stmt = $this->conn->query("SELECT * FROM livros");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function cadastrar($dados) {
        $sql = "INSERT INTO livros (titulo, autor, categoria, sinopse, custo_aluguel, imagem, tempo_aluguel) 
                VALUES (:titulo, :autor, :categoria, :sinopse, :custo_aluguel, :imagem, :tempo_aluguel)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":titulo", $dados['titulo']);
        $stmt->bindParam(":autor", $dados['autor']);
        $stmt->bindParam(":categoria", $dados['categoria']);
        $stmt->bindParam(":sinopse", $dados['sinopse']);
        $stmt->bindParam(":custo_aluguel", $dados['custo_aluguel']);
        $stmt->bindParam(":imagem", $dados['imagem']);
        $stmt->bindParam(":tempo_aluguel", $dados['tempo_aluguel']);
        return $stmt->execute();
    }
}