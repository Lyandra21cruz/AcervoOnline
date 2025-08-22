<?php
// processa_cadastro.php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../Controllers/LivroController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'nome' => $_POST['nome'],
        'categoria' => $_POST['categoria'],
        'custo_aluguel' => $_POST['custo_aluguel'],
        'dias_emprestimo' => $_POST['dias_emprestimo']
    ];

    $controller = new LivroController($db);

    if ($controller->cadastrarLivro($dados)) {
        echo "<p>✅ Livro cadastrado com sucesso!</p>";
        echo "<a href='Views/buscar_Livro.phpp'>Ir para busca de livros</a>";
    } else {
        echo "<p>❌ Erro ao cadastrar o livro.</p>";
        echo "<a href='Views/cadastrar_Livro.php'>Tentar novamente</a>";
    }
} else {
    header("Location: Views/cadastrar_Livro.php");
    exit;
}
