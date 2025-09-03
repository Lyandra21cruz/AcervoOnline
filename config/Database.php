<?php
class Database {
    private static $host = "localhost";
    private static $db   = "biblioteca"; // coloque o nome do seu banco
    private static $user = "root";              // padrão do XAMPP
    private static $pass = "";                  // senha (normalmente vazia no XAMPP)
    private static $pdo  = null;

    public static function getConnection() {
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8",
                    self::$user,
                    self::$pass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
