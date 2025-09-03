<?php
class Database {
    private $host = "localhost";
    private $db_name = "biblioteca"; // seu banco
    private $username = "root";      // usuário do XAMPP
    private $password = "";          // senha do MySQL (se tiver)
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
