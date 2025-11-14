<?php
session_start();

if (isset($_GET['index'])) {
    $i = intval($_GET['index']);
    if (isset($_SESSION['carrinho'][$i])) {
        unset($_SESSION['carrinho'][$i]);
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // reorganiza
    }
}

header("Location: carrinho.php");
exit;
?>
