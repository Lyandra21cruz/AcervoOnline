<?php
session_start();
require_once "C:/Turma2/xampp/htdocs/AcervoOnline/Views/usuario/conexao.php";

if (!isset($_SESSION['pagamento_carrinho'])) {
    header("Location: carrinho.php");
    exit;
}

$id_usuario = $_SESSION['usuario']['id_usuario'];
$carrinho = $_SESSION['pagamento_carrinho'];

$reciboId = time();
$reciboHtml = "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
<meta charset='UTF-8'>
<title>Recibo $reciboId</title>

<body>
<style>
/* ===== FUNDO ===== */
body {
    margin: 0;
    padding: 40px;
    background: linear-gradient(145deg, #4b2e1e, #52341dff, #a98a62ff);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    font-family: serif;
}

/* ===== RECIBO ===== */
.card {
    width: 95%;
    max-width: 750px;
    background: #fcf7f2;
    padding: 60px 55px;
    border-radius: 12px;
    border: 2px solid #c9b59e;
    box-shadow: 0 10px 35px rgba(0,0,0,0.25);
    color: #2e1d14;
}

/* ===== TÍTULOS ===== */
.card h1 {
    text-align: center;
    font-size: 42px;
    font-weight: 900;
    margin: 0;
    color: #3c2417;
}

.card h2 {
    text-align: center;
    font-size: 22px;
    margin-top: 8px;
    margin-bottom: 25px;
    letter-spacing: 1px;
    color: #55372a;
}

/* ===== LINHA ===== */
.linha {
    width: 100%;
    height: 2px;
    background: #b89a7c;
    margin: 25px 0;
}

/* ===== LISTA DE ITENS ===== */
.item-livro {
    display: flex;
    align-items: center;
    padding: 18px 10px;
    background: #f4e8d8;
    border-radius: 12px;
    border: 1px solid #d7c1a8;
    margin-bottom: 18px;
}

.item-livro img {
    width: 85px;
    height: 115px;
    border-radius: 10px;
    margin-right: 20px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.info {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.info .titulo {
    font-size: 19px;
    font-weight: 800;
    color: #3b2518;
}

.info .autor {
    font-size: 15px;
    color: #6d4d38;
}

/* ===== PREÇO ===== */
.preco {
    margin-left: auto;
    font-size: 18px;
    font-weight: bold;
    color: #2e1d14;
}

/* ===== OBRIGADO ===== */
.thanks {
    margin-top: 40px;
    text-align: center;
    font-size: 24px;
    font-weight: 900;
    color: #4b2e2e;
}


</style>

</head>
<body>
<div class='card'>
    <h1>RECIBO</h1>
    <h2>LIVRO DE ACERVO ONLINE</h2>

    <div class='linha'></div>

    <ul>

";


foreach ($carrinho as $livro) {

    $titulo = $livro['titulo'];
    $autor = $livro['autor'];
    $preco = $livro['preco'];
    $imagem = $livro['imagem'];
    $pdf = isset($livro['pdf']) ? $livro['pdf'] : null;

    // SALVAR NA TABELA
    $sql = $pdo->prepare("
        INSERT INTO compras (id_usuario, titulo, autor, preco, imagem, pdf, status)
        VALUES (?,?,?,?,?,?, 'CONCLUIDA')
    ");
    $sql->execute([$id_usuario, $titulo, $autor, $preco, $imagem, $pdf]);

  $reciboHtml .= "
<li class='item-livro'>
    <img src='../../../uploads/$imagem'>
    <div class='info'>
        <div class='titulo'>$titulo</div>
        <div class='autor'>$autor</div>
    </div>
    <div class='preco'>R$ " . number_format($preco,2,",",".") . "</div>
</li>";

    // baixar pdf automaticamente se existir
    if ($pdf) {
    $origem = "../../uploads/pdf/" . $pdf;   // caminho real do pdf original
    $destino = "pdf_compras/" . $pdf;  // para onde vai o arquivo comprado

    // copiar o pdf real
    if (file_exists($origem)) {
        copy($origem, $destino);
        $_SESSION['pdf_download'][] = $destino;
    }
}
}

$reciboHtml .= "
       </ul>

    <div class='linha'></div>

    <p class='thanks'>Obrigado pela compra!</p>
</div>

</div>

</body>
</html>
";

// salvar recibo
$file = "recibos/recibo_$reciboId.html";
file_put_contents($file, $reciboHtml);

// limpa carrinho da etapa
unset($_SESSION['pagamento_carrinho']);

header("Location: compra_concluida.php?recibo=$reciboId");
exit;
?>
