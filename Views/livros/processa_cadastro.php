<?php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../Controllers/LivroController.php';
// Cria conexão
$database = new Database();
$db = $database->getConnection();

// Passa $db ao criar o controller
$controller = new LivroController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Upload da imagem
    $imagem_nome = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === 0) {
        $pasta = "../../uploads/";
        if (!is_dir($pasta)) mkdir($pasta, 0777, true);
        $imagem_nome = time() . "_" . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $imagem_nome);
    }

    $dados = [
        "titulo" => $_POST['titulo'] ?? null,
        "autor" => $_POST['autor'] ?? null,
        "sinopse" => $_POST['sinopse'] ?? null,
        "custo_aluguel" => $_POST['custo_aluguel'] ?? null,
        "tempo_aluguel" => $_POST['tempo_aluguel'] ?? null,
        "imagem" => $imagem_nome
    ];

    if ($controller->cadastrarLivro($dados)) {
        echo "<p>✅ Livro cadastrado com sucesso!</p>";
    } else {
        echo "<p>❌ Erro ao cadastrar livro. Preencha todos os campos obrigatórios.</p>";
    }
} else {
    header("Location: cadastrar_Livro.php");
    exit;
}