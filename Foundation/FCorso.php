<?php

class FCorso {
    
    // Salva un nuovo corso nel database
    public static function store(ECorso $corso) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "INSERT INTO Corso (nome, descrizione, capienza_max) VALUES (:nome, :descrizione, :capienza_max)";
        $stmt = $db->prepare($query);
        
        $stmt->bindValue(':nome', $corso->getNome());
        $stmt->bindValue(':descrizione', $corso->getDescrizione());
        $stmt->bindValue(':capienza_max', $corso->getCapienzaMax());
        
        $stmt->execute();
        $corso->setId($db->lastInsertId());
        
        return $corso->getId();
    }

    // Recupera un corso specifico dal suo ID
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "SELECT * FROM Corso WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $corso = new ECorso($row['nome'], $row['descrizione'], $row['capienza_max']);
            $corso->setId($row['id']);
            return $corso;
        }
        return null;
    }

    // Recupera tutti i corsi (utile per la pagina pubblica "I nostri corsi")
    public static function loadAll() {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Corso";
        $stmt = $db->query($query);
        
        $corsi = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $corso = new ECorso($row['nome'], $row['descrizione'], $row['capienza_max']);
            $corso->setId($row['id']);
            $corsi[] = $corso;
        }
        return $corsi;
    }
}
?>