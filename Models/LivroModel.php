<?php
require_once __DIR__ . '/../config/conexao.php';

class LivroModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastrar livro
    public function cadastrar($nome, $categoria, $custo, $dias) {
        $sql = "INSERT INTO livros (nome, categoria, custo_aluguel, dias_emprestimo) 
                VALUES (:nome, :categoria, :custo, :dias)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':categoria' => $categoria,
            ':custo' => $custo,
            ':dias' => $dias
        ]);
    }

    // Buscar livros com filtros
    public function buscar($categoria = null, $precoMax = null, $ordenar = "recentes") {
        $sql = "SELECT * FROM livros WHERE 1=1";
        
        if ($categoria) {
            $sql .= " AND categoria = :categoria";
        }
        if ($precoMax) {
            $sql .= " AND custo_aluguel <= :preco";
        }
        if ($ordenar == "recentes") {
            $sql .= " ORDER BY data_cadastro DESC";
        } else {
            $sql .= " ORDER BY custo_aluguel ASC";
        }

        $stmt = $this->conn->prepare($sql);
        if ($categoria) $stmt->bindValue(":categoria", $categoria);
        if ($precoMax) $stmt->bindValue(":preco", $precoMax);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}