<?php
class Conexao {
    public static function conectar() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=biblioteca;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}
