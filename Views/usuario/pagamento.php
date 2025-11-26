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
<style>

/* ======== FUNDO ======== */
body {
    margin: 0;
    padding: 0;
    font-family: "Inter", sans-serif;
    background: url("../../img/cabeçabranca3.png") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: flex-end; /* empurra o conteúdo para a direita */
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* ======== CARD ======== */
.caixa {
    background: rgba(243, 233, 221, 0.65); /* mais transparente */
    width: 100%;
    max-width: 420px; /* menor */
    padding: 32px;
    text-align: center;
    border-radius: 26px;
    box-shadow:
        0 22px 45px rgba(0, 0, 0, 0.30),
        inset 0 0 12px rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255,255,255,0.4);
    animation: fade .6s ease forwards;
    backdrop-filter: blur(6px);
    margin-right: 40px; /* desloca mais pra direita */
}

/* ======== TÍTULO ======== */
h1 {
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 22px;
    color: #4b3a2e;
}

/* ======== LISTA DOS ITENS ======== */
ul {
    list-style: none;
    padding: 0;
    margin-bottom: 22px;
}

ul li {
    background: rgba(255, 255, 255, 0.88);
    padding: 14px 16px;
    border-radius: 16px;
    margin-bottom: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 16px;
    color: #4b3a2e;
    font-weight: 600;
    box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    transition: 0.3s;
}

ul li:hover {
    transform: scale(1.02);
}

/* ======== TOTAL ======== */
h2 {
    font-size: 20px;
    margin: 18px 0 28px;
    color: #4b3a2e;
    font-weight: 700;
}

/* ======== SUBTÍTULO ======== */
h3 {
    margin-top: 5px;
    margin-bottom: 14px;
    color: #4b3a2e;
    font-size: 17px;
    font-weight: 700;
}

/* ======== QR CODE ======== */
.qr-box {
    background: rgba(255, 255, 255, 0.75); /* mais transparente */
    padding: 20px;
    border-radius: 20px;
    margin: 0 auto;
    box-shadow:
        0 14px 30px rgba(0,0,0,0.16),
        inset 0 0 10px rgba(0,0,0,0.05);
    border: 1px solid rgba(255,255,255,0.4);
    transition: 0.3s;
}

.qr-box:hover {
    transform: scale(1.02);
}

.qr-box img {
    width: 100%;
    max-width: 220px;
    border-radius: 14px;
}

/* ======== CÓDIGO OPERAÇÃO ======== */
p {
    margin-top: 16px;
    font-size: 16px;
    color: #4b3a2e;
    font-weight: bold;
}

/* ======== BOTÃO ======== */
.botao {
    margin-top: 32px;
    display: block;
    text-decoration: none;
    background: #4b3a2e;
    color: white;
    padding: 16px;
    border-radius: 14px;
    font-size: 17px;
    font-weight: 700;
    box-shadow: 0 10px 22px rgba(0,0,0,0.28);
    transition: .3s;
}

.botao:hover {
    background: #3b2d22;
    transform: translateY(-3px);
}

/* ======== ANIMAÇÃO ======== */
@keyframes fade {
    from { opacity: 0; transform: translateY(25px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ======== RESPONSIVIDADE ======== */
@media (max-width: 780px) {
    body {
        justify-content: center; /* no celular volta para o centro */
        padding: 15px;
    }

    .caixa {
        margin-right: 0;
        max-width: 90%;
    }
}

</style>


<body>
<div class="caixa">
    <h1>Pagamento</h1>

    <ul>
        <?php foreach($carrinho as $livro): ?>
            <li>
                <span><?php echo $livro['titulo']; ?></span>
                <span>R$ <?php echo number_format($livro['preco'], 2, ",", "."); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Total: R$ <?php echo number_format($total, 2, ",", "."); ?></h2>

    <h3>Escaneie o QR Code:</h3>

    <div class="qr-box">
        <img src="../../img/images.png">
    </div>

    <p>Código da operação: <b><?php echo $codigo; ?></b></p>

    <a href="confirmar_pagamento.php" class="botao">Confirmar Pagamento</a>
</div>
</body>
