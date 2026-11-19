<?php
// File: Foundation/FLezioneIndividuale.php

class FLezioneIndividuale {

    private static function buildEntity(array $row) {
        $lezione = new ELezioneIndividuale(
            $row['id_istruttore'],
            $row['data_ora_inizio'],
            $row['data_ora_fine'],
            $row['id_utente'],
            $row['stato'],
            $row['motivazione_annullamento']
        );
        $lezione->setId($row['id']);
        return $lezione;
    }

    // Inserisce un nuovo slot di disponibilità
    public static function store(ELezioneIndividuale $lezione) {
        $db = FDatabase::getInstance()->getDb();
        $query = "INSERT INTO LezioneIndividuale (id_istruttore, id_utente, data_ora_inizio, data_ora_fine, stato, motivazione_annullamento)
                  VALUES (:id_istruttore, :id_utente, :inizio, :fine, :stato, :motivazione)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $lezione->getIdIstruttore(), PDO::PARAM_INT);
        $stmt->bindValue(':id_utente', $lezione->getIdUtente(), $lezione->getIdUtente() === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':inizio', $lezione->getDataOraInizio());
        $stmt->bindValue(':fine', $lezione->getDataOraFine());
        $stmt->bindValue(':stato', $lezione->getStato());
        $stmt->bindValue(':motivazione', $lezione->getMotivazioneAnnullamento());

        if ($stmt->execute()) {
            return $db->lastInsertId();
        }
        return false;
    }

    // Carica un singolo slot tramite ID
    public static function load($id) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM LezioneIndividuale WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::buildEntity($row) : null;
    }

    // Elimina uno slot libero (non prenotato)
    public static function deleteDisponibilita($id, $id_istruttore) {
        $db = FDatabase::getInstance()->getDb();
        $query = "DELETE FROM LezioneIndividuale 
                  WHERE id = :id AND id_istruttore = :id_istruttore AND stato = 'disponibile'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Verifica se l'istruttore ha già uno slot individuale attivo o un corso di gruppo nella stessa fascia oraria
    public static function hasSovrapposizione($id_istruttore, $inizio, $fine) {
        $db = FDatabase::getInstance()->getDb();

        // 1. Controllo su altre lezioni individuali attive
        $q1 = "SELECT COUNT(*) FROM LezioneIndividuale
               WHERE id_istruttore = :id_istruttore
                 AND stato != 'annullata_istruttore'
                 AND data_ora_inizio < :fine
                 AND data_ora_fine > :inizio";
        $s1 = $db->prepare($q1);
        $s1->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $s1->bindValue(':inizio', $inizio);
        $s1->bindValue(':fine', $fine);
        $s1->execute();
        if ((int)$s1->fetchColumn() > 0) {
            return true;
        }

        // 2. Controllo sui corsi di gruppo assegnati dall'Admin
        $q2 = "SELECT COUNT(*) FROM Lezione
               WHERE id_istruttore = :id_istruttore
                 AND data_ora_inizio < :fine
                 AND data_ora_fine > :inizio";
        $s2 = $db->prepare($q2);
        $s2->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $s2->bindValue(':inizio', $inizio);
        $s2->bindValue(':fine', $fine);
        $s2->execute();
        return (int)$s2->fetchColumn() > 0;
    }

    // Carica tutti gli slot futuri (e recenti) di un istruttore per la sua gestione
    public static function loadByIstruttore($id_istruttore) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM LezioneIndividuale
                  WHERE id_istruttore = :id_istruttore
                  ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->execute();

        $risultati = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $risultati[] = self::buildEntity($row);
        }
        return $risultati;
    }

    // Carica solo gli slot futuri disponibili di un istruttore (per il mini-calendario dell'allievo)
    public static function loadDisponibiliByIstruttore($id_istruttore) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM LezioneIndividuale
                  WHERE id_istruttore = :id_istruttore
                    AND stato = 'disponibile'
                    AND data_ora_inizio >= NOW()
                  ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->execute();

        $risultati = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $risultati[] = self::buildEntity($row);
        }
        return $risultati;
    }

    // Carica le lezioni individuali di un allievo (prenotate e annullate dall'istruttore)
    public static function loadByUtente($id_utente) {
        $db = FDatabase::getInstance()->getDb();
        $query = "SELECT * FROM LezioneIndividuale
                  WHERE id_utente = :id_utente
                  ORDER BY data_ora_inizio ASC";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_utente', $id_utente, PDO::PARAM_INT);
        $stmt->execute();

        $risultati = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $risultati[] = self::buildEntity($row);
        }
        return $risultati;
    }

    // Prenotazione atomica da parte dell'allievo
    public static function prenota($id, $id_utente) {
        $db = FDatabase::getInstance()->getDb();
        $query = "UPDATE LezioneIndividuale
                  SET id_utente = :id_utente, stato = 'prenotata'
                  WHERE id = :id AND stato = 'disponibile' AND id_utente IS NULL";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id_utente', $id_utente, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Annullamento da parte dell'istruttore con salvataggio della motivazione
    public static function annullaDaIstruttore($id, $id_istruttore, $motivazione) {
        $db = FDatabase::getInstance()->getDb();
        $query = "UPDATE LezioneIndividuale
                  SET stato = 'annullata_istruttore', motivazione_annullamento = :motivazione
                  WHERE id = :id AND id_istruttore = :id_istruttore AND stato = 'prenotata'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':motivazione', $motivazione);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':id_istruttore', $id_istruttore, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Disdetta da parte dell'allievo: lo slot torna immediatamente disponibile
    public static function disdiciDaUtente($id, $id_utente) {
        $db = FDatabase::getInstance()->getDb();
        $query = "UPDATE LezioneIndividuale
                  SET id_utente = NULL, stato = 'disponibile', motivazione_annullamento = NULL
                  WHERE id = :id AND id_utente = :id_utente AND stato = 'prenotata'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':id_utente', $id_utente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
?>