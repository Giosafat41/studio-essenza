<?php

class FPrenotazione {
    
    // Salva una nuova prenotazione
    public static function store(EPrenotazione $prenotazione) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "INSERT INTO Prenotazione (id_utente, id_lezione, stato_presenza) 
                  VALUES (:id_utente, :id_lezione, :stato_presenza)";
        $stmt = $db->prepare($query);
        
        $stmt->bindValue(':id_utente', $prenotazione->getIdUtente());
        $stmt->bindValue(':id_lezione', $prenotazione->getIdLezione());
        $stmt->bindValue(':stato_presenza', $prenotazione->getStatoPresenza());
        
        $stmt->execute();
        $prenotazione->setId($db->lastInsertId());
        
        return $prenotazione->getId();
    }

    // Carica una prenotazione
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        
        $query = "SELECT * FROM Prenotazione WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $prenotazione = new EPrenotazione($row['id_utente'], $row['id_lezione'], $row['stato_presenza']);
            $prenotazione->setId($row['id']);
            $prenotazione->setDataPrenotazione($row['data_prenotazione']);
            return $prenotazione;
        }
        return null;
    }
    // Recupera tutte le prenotazioni di uno specifico allievo (per la dashboard Allievo)
    public static function loadByUtente($id_utente) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Prenotazione WHERE id_utente = :id_utente ORDER BY data_prenotazione DESC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_utente', $id_utente);
        $stmt->execute();
        
        $prenotazioni = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pren = new EPrenotazione($row['id_utente'], $row['id_lezione'], $row['stato_presenza']);
            $pren->setId($row['id']);
            $pren->setDataPrenotazione($row['data_prenotazione']);
            $prenotazioni[] = $pren;
        }
        return $prenotazioni;
    }

    // Recupera tutti gli allievi iscritti a una lezione (per l'appello dell'istruttore)
    public static function loadByLezione($id_lezione) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM Prenotazione WHERE id_lezione = :id_lezione";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_lezione', $id_lezione);
        $stmt->execute();
        
        $prenotazioni = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pren = new EPrenotazione($row['id_utente'], $row['id_lezione'], $row['stato_presenza']);
            $pren->setId($row['id']);
            $prenotazioni[] = $pren;
        }
        return $prenotazioni;
    }
}
?>