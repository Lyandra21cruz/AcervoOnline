<?php
require_once __DIR__ . "/../../config/conexao.php";

$conn = Conexao::conectar();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = (int) $_POST["id"];

    $sql = "SELECT id_livro, titulo, autor, sinopse, imagem, custo_aluguel, tempo_aluguel 
            FROM livros WHERE id_livro = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($livro) {
        echo json_encode($livro, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "Livro não encontrado"]);
    }
    exit;
}
echo json_encode(["erro" => "Requisição inválida"]);