<?php

class FUtente {

    private static $schemaChecked = false;

    // Garantisce che la colonna deve_cambiare_password esista anche su database già popolati
    private static function ensurePasswordFlagColumn(PDO $db) {
        if (self::$schemaChecked) {
            return;
        }
        self::$schemaChecked = true;
        try {
            $check = $db->query("SHOW COLUMNS FROM Utente LIKE 'deve_cambiare_password'");
            if ($check && !$check->fetch(PDO::FETCH_ASSOC)) {
                $db->exec("ALTER TABLE Utente ADD COLUMN deve_cambiare_password TINYINT(1) NOT NULL DEFAULT 0 AFTER tariffa_individuale");
            }
        } catch (PDOException $e) {
            // Ignora eventuali race condition se la colonna è già stata aggiunta
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
            !empty($row['deve_cambiare_password'])
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
        self::ensurePasswordFlagColumn($db);

        $query = "INSERT INTO Utente (nome, cognome, email, password, telefono, ruolo, crediti_residui, scadenza_certificato, descrizione, immagine_profilo, tariffa_individuale, deve_cambiare_password) 
                  VALUES (:nome, :cognome, :email, :password, :telefono, :ruolo, :crediti_residui, :scadenza_certificato, :descrizione, :immagine_profilo, :tariffa_individuale, :deve_cambiare_password)";
        
        $stmt = $db->prepare($query);
        
        // Collega i parametri ai valori dell'oggetto Entity
        $stmt->bindValue(':nome', $utente->getNome());
        $stmt->bindValue(':cognome', $utente->getCognome());
        $stmt->bindValue(':email', $utente->getEmail());
        // Cifra la password prima di salvarla nel DB per sicurezza
        $stmt->bindValue(':password', password_hash($utente->getPassword(), PASSWORD_DEFAULT)); 
        $stmt->bindValue(':telefono', $utente->getTelefono());
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
        self::ensurePasswordFlagColumn($db);
        
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
        self::ensurePasswordFlagColumn($db);
        
        $query = "UPDATE Utente 
                  SET nome = :nome,
                      cognome = :cognome,
                      email = :email,
                      telefono = :telefono,
                      ruolo = :ruolo,
                      crediti_residui = :crediti, 
                      scadenza_certificato = :scadenza,
                      descrizione = :descrizione,
                      immagine_profilo = :immagine_profilo,
                      tariffa_individuale = :tariffa_individuale,
                      deve_cambiare_password = :deve_cambiare_password 
                  WHERE id = :id";
        $stmt = $db->prepare($query);
        
        $scadenza = $utente->getScadenzaCertificato();
        $descrizione = $utente->getDescrizione();
        $immagine = $utente->getImmagineProfilo();
        $tariffa = $utente->getTariffaIndividuale();
        
        $stmt->bindValue(':nome', $utente->getNome());
        $stmt->bindValue(':cognome', $utente->getCognome());
        $stmt->bindValue(':email', $utente->getEmail());
        $stmt->bindValue(':telefono', $utente->getTelefono());
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
        self::ensurePasswordFlagColumn($db);

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
        self::ensurePasswordFlagColumn($db);
        
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
        $query = "SELECT * FROM Utente ORDER BY cognome ASC, nome ASC";
        $stmt = $db->query($query);
        
        $utenti = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utenti[] = self::buildEntity($row);
        }
        return $utenti;
    }

    // Recupera tutti gli istruttori (o admin) per i menu a tendina del calendario
    public static function loadIstruttori() {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Utente WHERE ruolo IN ('istruttore', 'admin')";
        $stmt = $db->query($query);
        
        $istruttori = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $istruttori[] = self::buildEntity($row);
        }
        return $istruttori;
    }
    // Recupera solo gli utenti con ruolo 'istruttore' (per le lezioni individuali)
    public static function loadSoloIstruttori() {
        $db = FDatabase::getInstance()->getDb();
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