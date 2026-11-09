<?php

class FDatabase {
    // Istanza statica della classe (Pattern Singleton)
    private static $instance = null;
    private $db;

    // Il costruttore è privato per impedire la creazione di connessioni multiple
    private function __construct() {
        try {
            // Parametri di connessione: host, nome database, utente, password
            $this->db = new PDO("mysql:host=localhost;dbname=studio_essenza;charset=utf8mb4", "root", "");
            
            // Imposta PDO per lanciare eccezioni in caso di errore SQL
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Errore di connessione al database: " . $e->getMessage());
        }
    }

    // Metodo per ottenere l'unica istanza della connessione
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new FDatabase();
        }
        return self::$instance;
    }

    // Ritorna l'oggetto PDO per eseguire le query
    public function getDb() {
        return $this->db;
    }
}
?>