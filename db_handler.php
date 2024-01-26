<?php

class Database {
    private const HOST = "localhost";
    private const DB_NAME = "rcarraro";
    private const USER = "rcarraro";
    private const PASSWORD = "OochohZ9ooGuaJop";

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
        $stmt = $this->conn->prepare("SELECT username, nome, cognome, ruolo  FROM utenti WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function register($username, $nome, $cognome, $email, $password, $ruolo = "user"){
        
        $stmt = $this->conn->prepare("SELECT username FROM utenti WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result();

        if($user->num_rows > 0){
            $stmt->close();
            throw new Exception("Username già in uso.");
        }
        
        
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
                    WHERE  username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getAbbonamentiUtente($idUtente){
        $query = "  SELECT abbonamenti.id, abbonamenti.nome,
                            data_stipula,
                            Date_add(data_stipula, INTERVAL abbonamenti.durata day) AS data_scadenza
                    FROM   utenti_abbonamenti
                            JOIN abbonamenti
                            ON utenti_abbonamenti.id_abbonamento = abbonamenti.id
                    WHERE  utenti_abbonamenti.username = ? 
                    ORDER BY data_scadenza DESC;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getDatiUtente($idUtente){
        $query = "  SELECT username, nome, cognome, email, password
                    FROM   utenti
                    WHERE  username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function getCertificatoUtente($idUtente){
        $query = "  SELECT certificatoPath, certificatoMedico as stato, scadenzaCertificato as scadenza
                    FROM   utenti
                    WHERE  utenti.username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; 
    }

    public function insertCertificato($idUtente, $certificatoPath){
        $query = "  UPDATE utenti
                    SET    certificatoPath = ?,
                           certificatoMedico = 'da validare',
                           scadenzaCertificato = Date_add(CURDATE(), INTERVAL 1 year)
                    WHERE  username = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $certificatoPath, $idUtente);
        $stmt->execute();
        $stmt->close();
    }

    public function getAbbonamenti(){
        $query = "  SELECT id, nome, durata, costo
                    FROM   abbonamenti";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result; 
    }

    public function getAllSchede(){
        $query = "  SELECT  scheda.id_scheda,
                            allenatori.nome AS nome_allenatore,
                            esercizi.nome,
                            schede_esercizi.giorno_settimana,
                            schede_esercizi.numero_set,
                            schede_esercizi.numero_ripetizioni
                    FROM   scheda
                            JOIN schede_esercizi
                            ON scheda.id_scheda = schede_esercizi.id_scheda
                            JOIN esercizi
                            ON schede_esercizi.id_esercizio = esercizi.id
                            JOIN allenatori
                            ON scheda.id_allenatore = allenatori.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getNumeroAbbonatiValidi(){
        $query = "  SELECT COUNT(*) AS numero 
                    FROM utenti_abbonamenti JOIN abbonamenti ON utenti_abbonamenti.id_abbonamento = abbonamenti.id 
                    WHERE data_stipula <= CURDATE() AND CURDATE() <= Date_add(data_stipula, INTERVAL abbonamenti.durata day);";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()["numero"];
    }

    public function getIncassi(){
        $query = "  SELECT SUM(costo) AS incasso
                    FROM utenti_abbonamenti JOIN abbonamenti ON utenti_abbonamenti.id_abbonamento = abbonamenti.id 
                    WHERE MONTH(data_stipula) = MONTH(CURDATE()) AND YEAR(data_stipula) = YEAR(CURDATE());";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()["incasso"];
    }

    public function getCertificatiDaValidare(){
        $query = "  SELECT count(*) as numero
                    FROM utenti 
                    WHERE ruolo = 'user' AND certificatoMedico = 'da validare'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()["numero"];
    }

    public function getTotaleUtenti(){
        $query = "  SELECT count(*) as numero
                    FROM utenti 
                    WHERE ruolo = 'user'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc()["numero"];
    }   

    public function getAndamentoIncassi(){
        $query = "  SELECT MONTHNAME(data_stipula) AS mese, SUM(costo) AS incasso
                    FROM utenti_abbonamenti JOIN abbonamenti ON utenti_abbonamenti.id_abbonamento = abbonamenti.id 
                    WHERE data_stipula <= CURDATE() AND CURDATE() <= Date_add(data_stipula, INTERVAL abbonamenti.durata day)
                    GROUP BY MONTH(data_stipula)
                    ORDER BY MONTH(data_stipula) DESC
                    LIMIT 5;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            $res[$row["mese"]] = $row["incasso"];
        }
        $stmt->close();
        return $res;
    }

    public function getAndamentoUtenti(){
        $query = "  SELECT DATE_FORMAT(dataRegistrazione, '%m-%Y') AS periodo, 
                    COUNT(*) AS numero 
                    FROM utenti 
                    WHERE dataRegistrazione >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH) 
                    GROUP BY periodo 
                    ORDER BY periodo DESC
                    LIMIT 5;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $res = array();
        while($row = $result->fetch_assoc()){
            $res[$row["periodo"]] = $row["numero"];
        }
        $stmt->close();
        return $res;
    }

    public function getAllUsers(){
        $query = "  SELECT username, nome, cognome, email, dataRegistrazione, certificatoPath
                    FROM utenti 
                    WHERE ruolo = 'user'
                    ORDER BY cognome ASC, nome ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getInfoAbbonamento($abbonamento){
        $query = "  SELECT nome, durata, costo
                    FROM abbonamenti 
                    WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $abbonamento);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getActiveAbbonamento($utente) {
        $query = "  SELECT abbonamenti.id, abbonamenti.nome,
                            data_stipula,
                            Date_add(data_stipula, INTERVAL abbonamenti.durata day) AS data_scadenza
                    FROM   utenti_abbonamenti
                            JOIN abbonamenti
                            ON utenti_abbonamenti.id_abbonamento = abbonamenti.id
                    WHERE  utenti_abbonamenti.username = ? AND data_stipula <= CURDATE() AND CURDATE() <= Date_add(data_stipula, INTERVAL abbonamenti.durata day);";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function attivaAbbonamento($utente, $abbonamento){
        $query = "  INSERT INTO utenti_abbonamenti (username, id_abbonamento, data_stipula) VALUES (?, ?, CURDATE())";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $utente, $abbonamento);
        $stmt->execute();
        $stmt->close();
    }

    public function getScheda($id_scheda){
        $query = "  SELECT scheda.id_scheda,
                            allenatori.nome AS nome_allenatore,
                            esercizi.nome,
                            schede_esercizi.giorno_settimana,
                            schede_esercizi.numero_set,
                            schede_esercizi.numero_ripetizioni
                    FROM   scheda
                            JOIN schede_esercizi
                            ON scheda.id_scheda = schede_esercizi.id_scheda
                            JOIN esercizi
                            ON schede_esercizi.id_esercizio = esercizi.id
                            JOIN allenatori
                            ON scheda.id_allenatore = allenatori.id
                    WHERE  scheda.id_scheda = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_scheda);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function addSchedaUtente($utente, $scheda){
        $query = "  DELETE FROM schede_utente WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $utente);
        $stmt->execute();
        $stmt->close();

        $query = "  INSERT INTO schede_utente (username, id_scheda) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $utente, $scheda);
        $stmt->execute();
        $stmt->close();
    }
}

?>