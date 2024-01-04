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
        $stmt = $this->conn->prepare("SELECT id, username, nome, cognome, ruolo  FROM utenti WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function register($username, $nome, $cognome, $email, $password, $ruolo = "user"){
        $stmt = $this->conn->prepare("INSERT INTO utenti (username, nome, cognome, email, password, ruolo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $nome, $cognome, $email, $password, $ruolo);
        $stmt->execute();
        $stmt->close();

        return $this->login($username, $password);
    }
}

?>