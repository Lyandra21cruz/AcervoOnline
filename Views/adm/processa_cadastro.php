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

   // Upload do PDF
    $pdf_nome = null;
    $possui_pdf = 0;
    if (isset($_FILES['arquivo_pdf']) && $_FILES['arquivo_pdf']['error'] === 0) {
        $pastaPdf = "../../uploads/pdf/";
        if (!is_dir($pastaPdf)) mkdir($pastaPdf, 0777, true);
        $pdf_nome = time() . "_" . basename($_FILES['arquivo_pdf']['name']);
        move_uploaded_file($_FILES['arquivo_pdf']['tmp_name'], $pastaPdf . $pdf_nome);
        $possui_pdf = 1;
    }

    
    // Dados para enviar ao controller
    $dados = [
        "titulo"      => $_POST['titulo'] ?? null,
        "autor"       => $_POST['autor'] ?? null,
        "sinopse"     => $_POST['sinopse'] ?? null,
        "custo_aluguel" => $_POST['custo_aluguel'] ?? null,
        "imagem"      => $imagem_nome,
        "categoria"   => $_POST['categoria'] ?? null,
        "possui_pdf"  => $possui_pdf,
        "arquivo_pdf" => $pdf_nome
    ];

    // Tenta cadastrar no banco
    if ($controller->cadastrarLivro($dados)) {
        echo "sucesso"; // importante pro JS
    } else {
        echo "erro";
    }

} else {
    header("Location: cadastrar_Livro.php");
    exit;
}