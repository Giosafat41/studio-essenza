<?php

class FUtente {

    private static $schemaChecked = false;

    // Garantisce che lo schema supporti ruolo 'segretaria', il flag password e l'unico admin integrato
    private static function ensureSchema(PDO $db) {
        if (self::$schemaChecked) {
            return;
        }
        self::$schemaChecked = true;
        try {
            // 1. Aggiunge 'segretaria' all'ENUM ruolo se non ancora presente
            $colRuolo = $db->query("SHOW COLUMNS FROM Utente LIKE 'ruolo'")->fetch(PDO::FETCH_ASSOC);
            if ($colRuolo && strpos($colRuolo['Type'] ?? '', "'segretaria'") === false) {
                $db->exec("ALTER TABLE Utente MODIFY COLUMN ruolo ENUM('allievo','istruttore','segretaria','admin') NOT NULL DEFAULT 'allievo'");
            }

            // 2. Aggiunge la colonna deve_cambiare_password se mancante
            $checkPwd = $db->query("SHOW COLUMNS FROM Utente LIKE 'deve_cambiare_password'");
            if ($checkPwd && !$checkPwd->fetch(PDO::FETCH_ASSOC)) {
                $db->exec("ALTER TABLE Utente ADD COLUMN deve_cambiare_password TINYINT(1) NOT NULL DEFAULT 0 AFTER tariffa_individuale");
            }

            // 2b. Aggiunge la colonna data_nascita se mancante
            $checkNascita = $db->query("SHOW COLUMNS FROM Utente LIKE 'data_nascita'");
            if ($checkNascita && !$checkNascita->fetch(PDO::FETCH_ASSOC)) {
                $db->exec("ALTER TABLE Utente ADD COLUMN data_nascita DATE DEFAULT NULL AFTER telefono");
            }

            // 3. Garantisce che esista sempre l'unico profilo admin integrato nel database
            $countAdmin = (int)$db->query("SELECT COUNT(*) FROM Utente WHERE ruolo = 'admin'")->fetchColumn();
            if ($countAdmin === 0) {
                $stmtAdmin = $db->prepare(
                    "INSERT INTO Utente (nome, cognome, email, password, telefono, ruolo, crediti_residui, deve_cambiare_password)
                     VALUES ('Admin', 'Studio Essenza', 'admin@gmail.com', :pwd, '123456789', 'admin', 0, 0)"
                );
                $stmtAdmin->bindValue(':pwd', password_hash('admin', PASSWORD_DEFAULT));
                $stmtAdmin->execute();
            }
        } catch (PDOException $e) {
            // Ignora eventuali race condition di migrazione parallela
        }
    }

    private static function buildEntity(array $row) {
        $u = new EUtente(
            $row['nome'],
            $row['cognome'],
            $row['email'],
            $row['password'],
            $row['telefono'],
            $row['ruolo'],
            $row['crediti_residui'],
            $row['scadenza_certificato'],
            $row['descrizione'] ?? null,
            $row['immagine_profilo'] ?? null,
            $row['tariffa_individuale'] ?? null,
            !empty($row['deve_cambiare_password']),
            $row['data_nascita'] ?? null
        );
        $u->setId($row['id']);
        if (isset($row['data_registrazione'])) {
            $u->setDataRegistrazione($row['data_registrazione']);
        }
        return $u;
    }

    // Salva un oggetto EUtente nel database
    public static function store(EUtente $utente) {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);

        $query = "INSERT INTO Utente (nome, cognome, email, password, telefono, data_nascita, ruolo, crediti_residui, scadenza_certificato, descrizione, immagine_profilo, tariffa_individuale, deve_cambiare_password) 
                  VALUES (:nome, :cognome, :email, :password, :telefono, :data_nascita, :ruolo, :crediti_residui, :scadenza_certificato, :descrizione, :immagine_profilo, :tariffa_individuale, :deve_cambiare_password)";
        
        $stmt = $db->prepare($query);
        
        // Collega i parametri ai valori dell'oggetto Entity
        $stmt->bindValue(':nome', $utente->getNome());
        $stmt->bindValue(':cognome', $utente->getCognome());
        $stmt->bindValue(':email', $utente->getEmail());
        // Cifra la password prima di salvarla nel DB per sicurezza
        $stmt->bindValue(':password', password_hash($utente->getPassword(), PASSWORD_DEFAULT)); 
        $stmt->bindValue(':telefono', $utente->getTelefono());
        $data_nascita = $utente->getDataNascita();
        $stmt->bindValue(':data_nascita', !empty($data_nascita) ? $data_nascita : null);
        $stmt->bindValue(':ruolo', $utente->getRuolo());
        $stmt->bindValue(':crediti_residui', $utente->getCreditiResidui());
        $stmt->bindValue(':scadenza_certificato', $utente->getScadenzaCertificato());
        $descrizione = $utente->getDescrizione();
        $stmt->bindValue(':descrizione', ($descrizione !== null && trim($descrizione) !== '') ? trim($descrizione) : null);
        $immagine = $utente->getImmagineProfilo();
        $stmt->bindValue(':immagine_profilo', ($immagine !== null && trim($immagine) !== '') ? trim($immagine) : null);
        $tariffa = $utente->getTariffaIndividuale();
        $stmt->bindValue(':tariffa_individuale', $tariffa !== null ? number_format((float)$tariffa, 2, '.', '') : null);
        $stmt->bindValue(':deve_cambiare_password', $utente->deveCambiarePassword() ? 1 : 0, PDO::PARAM_INT);
        
        $stmt->execute();
        
        // Recupera l'ID autogenerato dal DB e lo imposta nell'oggetto
        $utente->setId($db->lastInsertId());
        
        return $utente->getId();
    }
    // Recupera un utente dal database tramite il suo ID e restituisce un oggetto EUtente
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        
        $query = "SELECT * FROM Utente WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildEntity($row) : null;
    }
    
    // Aggiorna tutti i dati anagrafici e operativi di un utente
    public static function update(EUtente $utente) {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        
        $query = "UPDATE Utente 
                  SET nome = :nome,
                      cognome = :cognome,
                      email = :email,
                      telefono = :telefono,
                      data_nascita = :data_nascita,
                      ruolo = :ruolo,
                      crediti_residui = :crediti, 
                      scadenza_certificato = :scadenza,
                      descrizione = :descrizione,
                      immagine_profilo = :immagine_profilo,
                      tariffa_individuale = :tariffa_individuale,
                      deve_cambiare_password = :deve_cambiare_password 
                  WHERE id = :id";
        $stmt = $db->prepare($query);
        
        $data_nascita = $utente->getDataNascita();
        $scadenza = $utente->getScadenzaCertificato();
        $descrizione = $utente->getDescrizione();
        $immagine = $utente->getImmagineProfilo();
        $tariffa = $utente->getTariffaIndividuale();
        
        $stmt->bindValue(':nome', $utente->getNome());
        $stmt->bindValue(':cognome', $utente->getCognome());
        $stmt->bindValue(':email', $utente->getEmail());
        $stmt->bindValue(':telefono', $utente->getTelefono());
        $stmt->bindValue(':data_nascita', !empty($data_nascita) ? $data_nascita : null);
        $stmt->bindValue(':ruolo', $utente->getRuolo());
        $stmt->bindValue(':crediti', $utente->getCreditiResidui(), PDO::PARAM_INT);
        $stmt->bindValue(':scadenza', !empty($scadenza) ? $scadenza : null);
        $stmt->bindValue(':descrizione', ($descrizione !== null && trim($descrizione) !== '') ? trim($descrizione) : null);
        $stmt->bindValue(':immagine_profilo', ($immagine !== null && trim($immagine) !== '') ? trim($immagine) : null);
        $stmt->bindValue(':tariffa_individuale', $tariffa !== null ? number_format((float)$tariffa, 2, '.', '') : null);
        $stmt->bindValue(':deve_cambiare_password', $utente->deveCambiarePassword() ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $utente->getId(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Aggiorna la password cifrata di un utente e azzera (di default) l'avviso di cambio password
    public static function updatePassword(int $id, string $nuova_password, bool $deve_cambiare_password = false) {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);

        $query = "UPDATE Utente
                  SET password = :password,
                      deve_cambiare_password = :deve_cambiare_password
                  WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':password', password_hash($nuova_password, PASSWORD_DEFAULT));
        $stmt->bindValue(':deve_cambiare_password', $deve_cambiare_password ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Recupera un utente dal database tramite la sua email (necessario per il login)
    public static function loadByEmail($email) {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        
        $query = "SELECT * FROM Utente WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildEntity($row) : null;
    }

    // Recupera tutti gli utenti iscritti ordinati per cognome e nome
    public static function loadAll() {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        $query = "SELECT * FROM Utente ORDER BY cognome ASC, nome ASC";
        $stmt = $db->query($query);
        
        $utenti = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utenti[] = self::buildEntity($row);
        }
        return $utenti;
    }

    // Recupera gli utenti filtrati per uno specifico elenco di ruoli (es. ['allievo', 'istruttore'] o ['segretaria', 'istruttore'])
    public static function loadByRuoli(array $ruoli) {
        if (empty($ruoli)) {
            return [];
        }
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        $placeholders = implode(', ', array_fill(0, count($ruoli), '?'));
        $query = "SELECT * FROM Utente WHERE ruolo IN ({$placeholders}) ORDER BY cognome ASC, nome ASC";
        $stmt = $db->prepare($query);
        foreach (array_values($ruoli) as $index => $ruolo) {
            $stmt->bindValue($index + 1, $ruolo);
        }
        $stmt->execute();

        $utenti = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utenti[] = self::buildEntity($row);
        }
        return $utenti;
    }

    // Recupera gli istruttori per i menu a tendina del calendario
    public static function loadIstruttori() {
        return self::loadSoloIstruttori();
    }
    // Recupera solo gli utenti con ruolo 'istruttore'
    public static function loadSoloIstruttori() {
        $db = FDatabase::getInstance()->getDb();
        self::ensureSchema($db);
        $query = "SELECT * FROM Utente WHERE ruolo = 'istruttore' ORDER BY cognome ASC, nome ASC";
        $stmt = $db->query($query);

        $istruttori = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $istruttori[] = self::buildEntity($row);
        }
        return $istruttori;
    }
}
?>