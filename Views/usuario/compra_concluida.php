<?php 
session_start(); 
$recibo = $_GET['recibo']; 
$downloads = $_SESSION['pdf_download'] ?? []; 
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Compra Concluída</title>

<style>

/* ==== FUNDO ==== */
body {
    margin: 0;
    padding: 0;
    font-family: "Inter", sans-serif;
    background: url("../../img/cabeçabranca3.png") no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* ==== CARD MODERNO (GLASS) ==== */
.card {
    background: rgba(255, 255, 255, 0.15); 
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    padding: 55px;
    width: 70%;
    max-width: 600px;
    text-align: center;
    border-radius: 35px;
    border: 1px solid rgba(255,255,255,0.35);
    box-shadow: 
        0 15px 40px rgba(0,0,0,0.25),
        inset 0 0 18px rgba(255,255,255,0.15);
    animation: surgir .7s ease;
}

/* Animação */
@keyframes surgir {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Logo */
.card img {
    margin-bottom: 20px;
    width: 95px;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.25));
}

/* Título */
h1 {
    font-family: "Georgia", serif;
    color: #3a1f1c;
    font-size: 36px;
    margin-bottom: 20px;
    font-weight: 800;
}

/* Texto */
p {
    font-size: 19px;
    color: #3a1f1c;
    margin-bottom: 40px;
}

/* ==== BOTÕES PREMIUM ==== */
.btn {
    display: block;
    width: 75%;
    max-width: 340px;
    margin: 12px auto;
    padding: 15px;
    font-size: 19px;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    color: #fff;
    border-radius: 14px;
    transition: .25s ease;
    box-shadow: 0 10px 22px rgba(0,0,0,0.25);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

/* Botão roxo / marrom elegante */
.btn-primary {
    background: linear-gradient(135deg, #5a2e2e, #7c4646);
}

.btn-primary:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow: 0 14px 28px rgba(0,0,0,0.28);
}

/* Botão de voltar */
.btn-secondary {
    background: linear-gradient(135deg, #3b2625, #5a3a39);
}

.btn-secondary:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow: 0 14px 28px rgba(0,0,0,0.28);
}

/* Ícones */
.btn i {
    font-size: 20px;
}

/* Responsivo */
@media (max-width: 480px) {
    .card {
        width: 90%;
        padding: 35px;
        border-radius: 28px;
    }

    h1 { font-size: 28px; }
    p  { font-size: 16px; }
    .btn { font-size: 17px; padding: 13px; }
}

</style>



<script>
window.onload = function() {
    <?php foreach ($downloads as $arquivo): ?>
        window.open("<?php echo $arquivo; ?>", "_blank");
    <?php endforeach; ?>
};
</script>

</head>
<body>

<div class="card">

    <img src="../../img/download (9).png" width="140">

    <h1>Compra concluída com sucesso!</h1>

    <p>Seu recibo está disponível:</p>

    <a class="btn btn-primary link-recibo" 
       href="recibos/recibo_<?php echo $recibo; ?>.html" 
       target="_blank">
        📄 Abrir Recibo
    </a>

    <br>

    <a class="btn btn-secondary voltar" href="dashboard.php">
        ⟵ Voltar ao início
    </a>

</div>

</body>
</html>

<?php 
unset($_SESSION['pdf_download']); 
unset($_SESSION['carrinho']); 
?>
