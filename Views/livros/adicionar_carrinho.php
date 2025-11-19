<?php
session_start();
require_once "C:/Turma2/xampp/htdocs/AcervoOnline/Views/usuario/conexao.php";


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$sql = $pdo->prepare("SELECT * FROM livros WHERE id_livro = ?");
$sql->execute([$id]);
$livro = $sql->fetch(PDO::FETCH_ASSOC);

if ($livro) {
    // Se o carrinho não existir, cria
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Adiciona o livro ao carrinho
    $_SESSION['carrinho'][] = [
        'id'     => $livro['id_livro'],
        'titulo' => $livro['titulo'],
        'autor'  => $livro['autor'],
        'imagem' => $livro['imagem'],
        'preco'  => $livro['custo_aluguel'],
        'pdf' => $livro['arquivo_pdf'] ?? 'não possui pdf'
    ];
}

header("Location: ../usuario/carrinho.php");
exit;
?>
