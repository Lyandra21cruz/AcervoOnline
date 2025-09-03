<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?pagina=login");
    exit;
}
?>
<h2>Bem-vindo, <?php echo $_SESSION['usuario']['nome']; ?>!</h2>
<p>Seu ID é: <?php echo $_SESSION['usuario']['id_usuario']; ?></p>
<a href="index.php?acao=sair">Sair</a>
