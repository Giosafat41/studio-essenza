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

    // Recupera tutti i corsi ordinati alfabeticamente
    public static function loadAll() {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Corso ORDER BY nome ASC";
        $stmt = $db->query($query);
        
        $corsi = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $corso = new ECorso($row['nome'], $row['descrizione'], $row['capienza_max']);
            $corso->setId($row['id']);
            $corsi[] = $corso;
        }
        return $corsi;
    }

    // Aggiorna un corso esistente
    public static function update(ECorso $corso) {
        $db = FDatabase::getInstance()->getDb();
        $query = "UPDATE Corso
                  SET nome = :nome,
                      descrizione = :descrizione,
                      capienza_max = :capienza_max
                  WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':nome', $corso->getNome());
        $stmt->bindValue(':descrizione', $corso->getDescrizione());
        $stmt->bindValue(':capienza_max', (int)$corso->getCapienzaMax(), PDO::PARAM_INT);
        $stmt->bindValue(':id', (int)$corso->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Elimina un corso dal database
    public static function delete(int $id) {
        $db = FDatabase::getInstance()->getDb();
        $query = "DELETE FROM Corso WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Conta quante lezioni risultano associate a un corso
    public static function countLezioni(int $id_corso) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT COUNT(*) FROM Lezione WHERE id_corso = :id_corso";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_corso', $id_corso, PDO::PARAM_INT);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
?>