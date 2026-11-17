<?php

class FUtente {
    
    // Salva un oggetto EUtente nel database
    public static function store(EUtente $utente) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "INSERT INTO Utente (nome, cognome, email, password, telefono, ruolo, crediti_residui, scadenza_certificato) 
                  VALUES (:nome, :cognome, :email, :password, :telefono, :ruolo, :crediti_residui, :scadenza_certificato)";
        
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
        
        $stmt->execute();
        
        // Recupera l'ID autogenerato dal DB e lo imposta nell'oggetto
        $utente->setId($db->lastInsertId());
        
        return $utente->getId();
    }
    // Recupera un utente dal database tramite il suo ID e restituisce un oggetto EUtente
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "SELECT * FROM Utente WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Ricostruisce l'oggetto Entity con i dati prelevati
            $utente = new EUtente(
                $row['nome'], 
                $row['cognome'], 
                $row['email'], 
                $row['password'],
                $row['telefono'], 
                $row['ruolo'], 
                $row['crediti_residui'], 
                $row['scadenza_certificato']
            );
            $utente->setId($row['id']);
            $utente->setDataRegistrazione($row['data_registrazione']);
            
            return $utente;
        }
        
        return null; // Utente non trovato
    }
    
    // Aggiorna i dati di un utente esistente
    public static function update(EUtente $utente) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "UPDATE Utente SET crediti_residui = :crediti WHERE id = :id";
        $stmt = $db->prepare($query);
        
        $stmt->bindValue(':crediti', $utente->getCreditiResidui());
        $stmt->bindValue(':id', $utente->getId());
        
        return $stmt->execute();
    }

    // Recupera un utente dal database tramite la sua email (necessario per il login)
    public static function loadByEmail($email) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "SELECT * FROM Utente WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $utente = new EUtente(
                $row['nome'], 
                $row['cognome'], 
                $row['email'], 
                $row['password'], 
                $row['telefono'], 
                $row['ruolo'], 
                $row['crediti_residui'], 
                $row['scadenza_certificato']
            );
            $utente->setId($row['id']);
            $utente->setDataRegistrazione($row['data_registrazione']);
            
            return $utente;
        }
        
        return null; // Nessun utente trovato con quella email
    }

    // Recupera tutti gli istruttori (o admin) per i menu a tendina del calendario
    public static function loadIstruttori() {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Utente WHERE ruolo IN ('istruttore', 'admin')";
        $stmt = $db->query($query);
        
        $istruttori = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $istruttore = new EUtente($row['nome'], $row['cognome'], $row['email'], $row['password'], $row['telefono'], $row['ruolo']);
            $istruttore->setId($row['id']);
            $istruttori[] = $istruttore;
        }
        return $istruttori;
    }
}
?>