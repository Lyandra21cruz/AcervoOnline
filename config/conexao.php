<?php
// config/conexao.php

define('HOST', 'localhost');
define('USER', 'root');     // seu usuário do MySQL
define('PASS', '');         // sua senha do MySQL (se tiver)
define('DBNAME', 'biblioteca'); // nome do banco de dados

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}