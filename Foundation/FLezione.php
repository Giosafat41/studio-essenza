<?php

class FLezione {
    
    private static function buildEntity(array $row) {
        $lezione = new ELezione(
            $row['id_corso'],
            $row['id_istruttore'],
            $row['data_ora_inizio'],
            $row['data_ora_fine'],
            isset($row['durata_minuti']) ? (int)$row['durata_minuti'] : null
        );
        $lezione->setId($row['id']);
        return $lezione;
    }

    // Salva una nuova lezione nel calendario
    public static function store(ELezione $lezione) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "INSERT INTO Lezione (id_corso, id_istruttore, data_ora_inizio, data_ora_fine, durata_minuti) 
                  VALUES (:id_corso, :id_istruttore, :data_ora_inizio, :data_ora_fine, :durata_minuti)";
        $stmt = $db->prepare($query);
        
        $stmt->bindValue(':id_corso', $lezione->getIdCorso(), PDO::PARAM_INT);
        $stmt->bindValue(':id_istruttore', $lezione->getIdIstruttore(), PDO::PARAM_INT);
        $stmt->bindValue(':data_ora_inizio', $lezione->getDataOraInizio());
        $stmt->bindValue(':data_ora_fine', $lezione->getDataOraFine());
        $stmt->bindValue(':durata_minuti', $lezione->getDurataMinuti(), PDO::PARAM_INT);
        
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
        return $row ? self::buildEntity($row) : null;
    }

    // Verifica se l'istruttore ha già una lezione di gruppo sovrapposta nella fascia oraria indicata
    public static function hasSovrapposizione($id_istruttore, $inizio, $fine, $exclude_lezione_id = null) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT COUNT(*) FROM Lezione
                  WHERE id_istruttore = :id_istruttore
                    AND data_ora_inizio < :fine
                    AND data_ora_fine > :inizio";
        if ($exclude_lezione_id !== null) {
            $query .= " AND id != :exclude_id";
        }
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->bindValue(':inizio', $inizio);
        $stmt->bindValue(':fine', $fine);
        if ($exclude_lezione_id !== null) {
            $stmt->bindValue(':exclude_id', (int)$exclude_lezione_id, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn() > 0;
    }

    // Cambia l'istruttore assegnato a una lezione di gruppo
    public static function updateIstruttore(int $id_lezione, int $id_istruttore) {
        $db = FDatabase::getInstance()->getDb();
        $query = "UPDATE Lezione SET id_istruttore = :id_istruttore WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id_lezione, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Elimina una lezione dal calendario (le prenotazioni collegate vengono rimosse via CASCADE)
    public static function delete(int $id_lezione) {
        $db = FDatabase::getInstance()->getDb();
        $query = "DELETE FROM Lezione WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id_lezione, PDO::PARAM_INT);
        return $stmt->execute();
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
            $lezioni[] = self::buildEntity($row);
        }
        return $lezioni;
    }

    // Recupera tutte le lezioni non ancora scadute (in corso o future), ordinate cronologicamente
    public static function loadDisponibili() {
        $db = FDatabase::getInstance()->getDb();
        $adesso = date('Y-m-d H:i:s');
        $query = "SELECT * FROM Lezione 
                  WHERE data_ora_fine >= :adesso 
                  ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':adesso', $adesso);
        $stmt->execute();

        $lezioni = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lezioni[] = self::buildEntity($row);
        }
        return $lezioni;
    }

    // Recupera tutti i corsi di gruppo assegnati a uno specifico istruttore
    public static function loadByIstruttore($id_istruttore) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Lezione 
                  WHERE id_istruttore = :id_istruttore 
                  ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->execute();

        $lezioni = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lezioni[] = self::buildEntity($row);
        }
        return $lezioni;
    }
}
?>