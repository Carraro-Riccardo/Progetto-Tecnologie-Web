<?php

class Database {
    private const HOST = "localhost";
    private const DB_NAME = "db_progetto_tw";
    private const USER = "root";
    private const PASSWORD = "";

    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DB_NAME);
            $this->conn -> set_charset("utf8");
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function __destruct() {
		if ($this->conn)
			$this->conn->close();
    }

    public function login($username, $password){
        $stmt = $this->conn->prepare("SELECT id, username, ruolo  FROM utenti WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }
}

?>