<?php
// File: Controller/CAdmin.php

class CAdmin {
    
    public function dashboard() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }
        $admin = FUtente::load($_SESSION['utente_id']);
        $view = new VAdmin();
        $view->mostraDashboard($admin->getNome());
    }

    // Gestione Ricarica Crediti
    public function ricaricaCrediti() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') exit;

        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_allievo'];
            $quantita = (int)$_POST['quantita_crediti'];

            $utente = FUtente::loadByEmail($email);
            
            if ($utente && $utente->getRuolo() === 'allievo') {
                $utente->ricaricaCrediti($quantita);
                FUtente::update($utente);
                $view->mostraFormRicarica("Successo! Nuovi crediti di {$utente->getNome()}: {$utente->getCreditiResidui()}");
            } else {
                $view->mostraFormRicarica(null, "Allievo non trovato o email errata.");
            }
        } else {
            $view->mostraFormRicarica();
        }
    }

    // Gestione Creazione Nuova Lezione
    public function aggiungiLezione() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') exit;

        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_corso = $_POST['id_corso'];
            $id_istruttore = $_POST['id_istruttore'];
            // Converte le date dal form HTML nel formato MySQL (YYYY-MM-DD HH:MM:SS)
            $data_inizio = str_replace('T', ' ', $_POST['data_ora_inizio']) . ':00';
            $data_fine = str_replace('T', ' ', $_POST['data_ora_fine']) . ':00';

            $lezione = new ELezione($id_corso, $id_istruttore, $data_inizio, $data_fine);
            FLezione::store($lezione);

            $view->mostraFormLezione([], [], "Lezione inserita con successo nel palinsesto!");
        } else {
            // Se la richiesta è GET, carichiamo i dati per i menu a tendina
            $corsi = FCorso::loadAll();
            $istruttori = FUtente::loadIstruttori();
            $view->mostraFormLezione($corsi, $istruttori);
        }
    }
    
    // Mostra l'appello per una specifica lezione
    public function appello() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') exit;

        $view = new VAdmin();
        
        if (isset($_GET['id_lezione'])) {
            $id_lezione = $_GET['id_lezione'];
            $prenotazioni = FPrenotazione::loadByLezione($id_lezione);
            
            $iscritti = [];
            foreach ($prenotazioni as $p) {
                $allievo = FUtente::load($p->getIdUtente());
                $iscritti[] = [
                    'nome' => $allievo->getNome(),
                    'cognome' => $allievo->getCognome(),
                    'telefono' => $allievo->getTelefono()
                ];
            }
            
            $lezione = FLezione::load($id_lezione);
            $corso = FCorso::load($lezione->getIdCorso());
            
            $dettagli_lezione = $corso->getNome() . " del " . date('d/m/Y H:i', strtotime($lezione->getDataOraInizio()));
            
            $view->smarty->assign('dettagli_lezione', $dettagli_lezione);
            $view->smarty->assign('iscritti', $iscritti);
            $view->smarty->assign('titolo_pagina', 'Appello Iscritti');
            $view->smarty->display('admin_appello.tpl');
        }
    }
}
?>