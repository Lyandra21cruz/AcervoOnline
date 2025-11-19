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

<style>
body {
    margin: 0;
    padding: 40px;
    background: #6b4135;
    font-family: 'Georgia', serif;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.card {
    width: 450px;
    background: #e7dbcd;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, .35);
}

h1 {
    text-align: left;
    color: #4b2e2e;
    font-size: 24px;
    margin-bottom: 25px;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.item-livro {
    background: #5b3a33;
    color: #fff;
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0,0,0,.25);
}

.item-livro img {
    width: 70px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 12px;
}

.info {
    display: flex;
    flex-direction: column;
}

.info .titulo {
    font-size: 17px;
    font-weight: bold;
}

.info .autor {
    font-size: 14px;
    opacity: 0.8;
}

.preco {
    margin-left: auto;
    font-size: 17px;
    font-weight: bold;
    background: #7a5047;
    padding: 6px 10px;
    border-radius: 8px;
}

.thanks {
    margin-top: 25px;
    font-size: 20px;
    color: #7a3b3b;
    text-align: center;
}

.btn-voltar {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 20px;
    background: #7a3b3b;
    color: #fff;
    border-radius: 10px;
    font-weight: bold;
    font-size: 16px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-voltar:hover {
    background: #5c2a2a;
}

</style>

</head>
<body>

<div class='card'>
    <h1>Recibo de Compra #$reciboId</h1>
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
    <p class='thanks'>Obrigado pela compra!</p>

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
