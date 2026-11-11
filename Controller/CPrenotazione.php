<?php
class CPrenotazione {

    // Metodo per effettuare una nuova prenotazione
    public function prenota() {
        // Simuliamo l'id utente loggato e l'id lezione scelti (in futuro arriveranno dalla sessione e dal form)
        $id_utente_loggato = 1; // Esempio: Utente ID 1
        $id_lezione_scelta = 2; // Esempio: Lezione ID 2

        // 1. Carica l'utente per controllare i crediti
        $utente = FUtente::load($id_utente_loggato);

        if ($utente->getCreditiResidui() > 0) {
            // 2. L'utente ha crediti. Scaliamo un credito.
            $utente->scalaCredito();
            // (Qui andrebbe un UPDATE nel database per salvare il nuovo saldo crediti tramite FUtente)

            // 3. Creiamo l'Entity Prenotazione
            $prenotazione = new EPrenotazione($id_utente_loggato, $id_lezione_scelta);

            // 4. Salviamo la prenotazione nel DB
            $esito = FPrenotazione::store($prenotazione);

            if ($esito) {
                echo "Prenotazione effettuata con successo! Crediti residui: " . $utente->getCreditiResidui();
            } else {
                echo "Errore durante la prenotazione.";
            }
        } else {
            echo "Non hai abbastanza crediti per prenotare. Passa in segreteria.";
        }
    }
}
?>