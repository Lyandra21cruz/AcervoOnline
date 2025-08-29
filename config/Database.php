<?php
class Database {
    private $host = "localhost";
    private $db_name = "biblioteca";
    private $username = "root";
    private $password = "";
    public $db;

    public function getConnection() {
        $this->db = null;
        try {
            $this->db = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password
            );
            $this->db->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->db;
    }
}
