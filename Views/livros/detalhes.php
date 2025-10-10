<?php
require_once __DIR__ . '/../../config/conexao.php';
$conn = Conexao::conectar();

if (!isset($_POST['id'])) {
    echo json_encode(['erro' => 'ID não informado']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM livros WHERE id_livro = ?");
$stmt->execute([$_POST['id']]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if ($livro) {
    echo json_encode($livro);
} else {
    echo json_encode(['erro' => 'Livro não encontrado']);
}
