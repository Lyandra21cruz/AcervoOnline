<?php
session_start();

if (!isset($_SESSION['pagamento_carrinho'])) {
    header("Location: carrinho.php");
    exit;
}

$carrinho = $_SESSION['pagamento_carrinho'];

$total = 0;
foreach ($carrinho as $livro) {
    $total += $livro['preco'];
}

$codigo = rand(100000, 999999);
$_SESSION['codigo_pagamento'] = $codigo;

$qrData = "Pagamento Codigo: $codigo";
$qrCodeUrl = "https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=" . urlencode($qrData);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Pagamento</title>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #6b4135; /* fundo elegante marrom */
        margin: 0;
        padding: 40px 0;
        display: flex;
        justify-content: center;
    }

    .caixa {
        background: #e7dbcd; /* bege suave */
        width: 440px;
        padding: 35px;
        border-radius: 16px;
        box-shadow: 0 6px 26px rgba(0,0,0,0.30);
        text-align: center;
    }

    h1 {
        font-family: Georgia, serif;
        color: #4b2e2e;
        font-size: 30px;
        margin-bottom: 10px;
    }

    h3 {
        font-family: Georgia, serif;
        color: #5b3a33;
        font-size: 18px;
        margin-bottom: 20px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
        text-align: left;
    }

    ul li {
        background: #5b3a33;
        color: #fff;
        margin-bottom: 12px;
        padding: 12px;
        border-radius: 10px;
        font-size: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    ul li span.titulo {
        font-weight: bold;
        max-width: 180px;
        display: block;
    }

    ul li span.preco {
        background: #7a5047;
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 15px;
    }

    h2 {
        font-family: Georgia, serif;
        color: #4b2e2e;
        font-size: 24px;
        margin-top: 20px;
    }

    /* QR CODE */
    .qr-box {
        background: #5b3a33;
        padding: 15px;
        border-radius: 12px;
        display: inline-block;
        margin: 20px 0;
        box-shadow: 0 3px 15px rgba(0,0,0,0.25);
    }

    .qr-box img {
        border-radius: 10px;
    }

    p {
        color: #4b2e2e;
        font-size: 17px;
        margin-top: 15px;
        font-weight: bold;
    }

    .botao {
        display: inline-block;
        width: 100%;
        background: #7a3b3b;
        color: white;
        padding: 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 18px;
        margin-top: 25px;
        transition: .2s;
        box-shadow: 0 3px 15px rgba(0,0,0,0.25);
    }

    .botao:hover {
        background: #5c2d2d;
    }


</style>

</head>
<body>

<div class="caixa">
    <h1>Pagamento</h1>
   <ul>
    <?php foreach($carrinho as $livro): ?>
        <li>
            <span class="titulo">📘 <?php echo $livro['titulo']; ?></span>
            <span class="preco">R$ <?php echo number_format($livro['preco'], 2, ",", "."); ?></span>
        </li>
    <?php endforeach; ?>
</ul>

<h2>Total: R$ <?php echo number_format($total, 2, ",", "."); ?></h2>

<h3>Escaneie o QR Code:</h3>

<div class="qr-box">
    <img src="../../img/images.png" width="260">
</div>

<p>Código da operação: <b><?php echo $codigo; ?></b></p>

    <a href="confirmar_pagamento.php" class="botao">Confirmar Pagamento</a>
</div>

</body>
</html>
