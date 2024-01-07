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

    public function getSchedeUtente($idUtente){
        $query = "  SELECT schede_utente.id_scheda,
                            allenatori.nome AS nome_allenatore,
                            esercizi.nome,
                            schede_esercizi.giorno_settimana,
                            schede_esercizi.numero_set,
                            schede_esercizi.numero_ripetizioni
                    FROM   schede_utente
                            JOIN scheda
                            ON schede_utente.id_scheda = scheda.id_scheda
                            JOIN schede_esercizi
                            ON schede_utente.id_scheda = schede_esercizi.id_scheda
                            JOIN esercizi
                            ON schede_esercizi.id_esercizio = esercizi.id
                            JOIN allenatori
                            ON scheda.id_allenatore = allenatori.id
                    WHERE  id_utente = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getAbbonamentiUtente($idUtente){
        $query = "  SELECT abbonamenti.nome,
                            data_stipula,
                            Date_add(data_stipula, INTERVAL abbonamenti.durata day) AS data_scadenza
                    FROM   utenti_abbonamenti
                            JOIN abbonamenti
                            ON utenti_abbonamenti.id_abbonamento = abbonamenti.id
                    WHERE  utenti_abbonamenti.id_utente = ? 
                    ORDER BY data_scadenza DESC;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getDatiUtente($idUtente){
        $query = "  SELECT username, nome, cognome, email, password
                    FROM   utenti
                    WHERE  id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getCertificatoUtente($idUtente){
        $query = "  SELECT certificatoPath, certificatoMedico as stato, scadenzaCertificato as scadenza
                    FROM   utenti
                    WHERE  utenti.id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; 
    }
}

?>