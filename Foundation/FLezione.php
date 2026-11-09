<?php

class FLezione {
    
    // Salva una nuova lezione nel calendario
    public static function store(ELezione $lezione) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "INSERT INTO Lezione (id_corso, id_istruttore, data_ora_inizio, data_ora_fine) 
                  VALUES (:id_corso, :id_istruttore, :data_ora_inizio, :data_ora_fine)";
        $stmt = $db->prepare($query);
        
        $stmt->bindValue(':id_corso', $lezione->getIdCorso());
        $stmt->bindValue(':id_istruttore', $lezione->getIdIstruttore());
        $stmt->bindValue(':data_ora_inizio', $lezione->getDataOraInizio());
        $stmt->bindValue(':data_ora_fine', $lezione->getDataOraFine());
        
        $stmt->execute();
        $lezione->setId($db->lastInsertId());
        
        return $lezione->getId();
    }

    // Recupera una lezione per ID
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "SELECT * FROM Lezione WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $lezione = new ELezione($row['id_corso'], $row['id_istruttore'], $row['data_ora_inizio'], $row['data_ora_fine']);
            $lezione->setId($row['id']);
            return $lezione;
        }
        return null;
    }
    // Recupera le lezioni di un determinato periodo (utile per il calendario frontend)
    public static function loadByDateRange($dataInizio, $dataFine) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Lezione WHERE data_ora_inizio >= :inizio AND data_ora_fine <= :fine ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':inizio', $dataInizio);
        $stmt->bindValue(':fine', $dataFine);
        $stmt->execute();
        
        $lezioni = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lezione = new ELezione($row['id_corso'], $row['id_istruttore'], $row['data_ora_inizio'], $row['data_ora_fine']);
            $lezione->setId($row['id']);
            $lezioni[] = $lezione;
        }
        return $lezioni;
    }
}
?>