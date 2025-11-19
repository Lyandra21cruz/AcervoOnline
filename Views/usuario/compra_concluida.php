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

body {
    background: #6b4135; /* Fundo do sistema */
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding-top: 60px;
    display: flex;
    justify-content: center;
}

.card {
    background: #e7dbcd; /* Cartão bege elegante */
    width: 480px;
    padding: 40px;
    border-radius: 22px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.25);
    text-align: center;
    animation: surgir .5s ease;
}

@keyframes surgir {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.card img {
    margin-bottom: 15px;
}

h1 {
    font-family: Georgia, serif;
    color: #4b2e2e;
    font-size: 30px;
    margin-bottom: 15px;
}

p {
    font-size: 19px;
    color: #4b2e2e;
}

a {
    font-weight: bold;
    text-decoration: none;
    transition: .25s;
}

/* Botão Recibo */
.link-recibo {
    background: #5b3a33;
    padding: 12px 22px;
    border-radius: 12px;
    color: #fff;
    font-size: 18px;
    display: inline-block;
    margin-top: 8px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.25);
}

.link-recibo:hover {
    background: #462c27;
}

/* Botão voltar */
.voltar {
    display: inline-block;
    margin-top: 28px;
    background: #7a3b3b;
    padding: 12px 25px;
    border-radius: 12px;
    color: #fff;
    font-size: 18px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.25);
}

.voltar:hover {
    background: #5c2d2d;
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

    <a class="link-recibo" 
       href="recibos/recibo_<?php echo $recibo; ?>.html" 
       target="_blank">
        📄 Abrir Recibo
    </a>

    <br>

    <a class="voltar" href="dashboard.php">⟵ Voltar ao início</a>

</div>

</body>
</html>

<?php 
unset($_SESSION['pdf_download']); 
unset($_SESSION['carrinho']); 
?>
