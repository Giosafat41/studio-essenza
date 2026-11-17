<?php
// File: Controller/CPrenotazione.php

class CPrenotazione {
    
    // Mostra il calendario delle lezioni future
    public function calendario() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id'])) {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        // Carica l'utente per sapere quanti crediti ha
        $utente = FUtente::load($_SESSION['utente_id']);
        
        // Calcola la data di oggi e quella tra 7 giorni
        $oggi = date('Y-m-d H:i:s');
        $prossimaSettimana = date('Y-m-d H:i:s', strtotime('+7 days'));
        
        // Recupera le lezioni dal DB
        $lezioni_entity = FLezione::loadByDateRange($oggi, $prossimaSettimana);
        
        // Prepariamo un array più comodo per Smarty, unendo la Lezione al nome del Corso
        $calendario_dati = [];
        foreach ($lezioni_entity as $lezione) {
            $corso = FCorso::load($lezione->getIdCorso());
            
            $calendario_dati[] = [
                'id_lezione' => $lezione->getId(),
                'nome_corso' => $corso->getNome(),
                // Formattiamo la data per renderla leggibile (es. 15 Nov - 18:00)
                'data_formattata' => date('d M - H:i', strtotime($lezione->getDataOraInizio()))
            ];
        }

        $view = new VPrenotazione();
        $view->mostraCalendario($calendario_dati, $utente->getCreditiResidui());
    }

    // Gestisce il click sul pulsante "Prenota"
    public function prenota() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_lezione = $_POST['id_lezione'];
        $id_utente = $_SESSION['utente_id'];

        $utente = FUtente::load($id_utente);
        $view = new VPrenotazione();

        // Controllo Crediti
        if ($utente->getCreditiResidui() > 0) {
            
            $prenotazione = new EPrenotazione($id_utente, $id_lezione);
            
            // Salviamo la prenotazione
            try {
                $esito = FPrenotazione::store($prenotazione);
                if ($esito) {
                    // Scaliamo il credito
                    $utente->scalaCredito();
                    FUtente::update($utente); // Ora funziona grazie al metodo aggiunto prima!
                    
                    // Rimandiamo alla dashboard
                    header("Location: index.php?controller=utente&action=dashboard");
                    exit;
                }
            } catch (Exception $e) {
                $view->mostraErrore("Hai già prenotato questa lezione!");
            }
        } else {
            $view->mostraErrore("Crediti esauriti. Non puoi prenotare questa lezione. Passa in segreteria.");
        }
    }

    // Disdice la lezione e rimborsa il credito
    public function cancella() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_prenotazione = $_POST['id_prenotazione'];
        $prenotazione = FPrenotazione::load($id_prenotazione);

        // Controllo di sicurezza: verifichiamo che la prenotazione esista e sia di questo utente
        if ($prenotazione && $prenotazione->getIdUtente() == $_SESSION['utente_id']) {
            // 1. Eliminiamo la prenotazione
            FPrenotazione::delete($id_prenotazione);
            
            // 2. Ricarichiamo 1 credito all'utente
            $utente = FUtente::load($_SESSION['utente_id']);
            $utente->ricaricaCrediti(1);
            FUtente::update($utente);
        }

        // Torniamo alla dashboard
        header("Location: index.php?controller=utente&action=dashboard");
        exit;
    }
}
?>