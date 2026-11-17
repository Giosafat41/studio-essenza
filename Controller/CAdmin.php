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
    // 1. Mostra la tabella con tutti gli utenti iscritti
    public function utenti() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $utenti = FUtente::loadAll();
        $messaggio = isset($_GET['msg']) ? $_GET['msg'] : null;

        $view = new VAdmin();
        $view->mostraUtenti($utenti, $messaggio);
    }

    // 2. Modifica tutti i dati di un utente esistente (incluso certificato medico)
    public function modificaUtente() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $utente = FUtente::load($id);

            if (!$utente) {
                header("Location: index.php?controller=admin&action=utenti");
                exit;
            }

            $nuova_email = trim($_POST['email']);
            // Verifica che la nuova email non appartenga già a un altro utente
            $esistente = FUtente::loadByEmail($nuova_email);
            if ($esistente && $esistente->getId() != $id) {
                $view->mostraFormUtente($utente, "Errore: l'email inserita è già utilizzata da un altro utente.");
                return;
            }

            $utente->setNome(trim($_POST['nome']));
            $utente->setCognome(trim($_POST['cognome']));
            $utente->setEmail($nuova_email);
            $utente->setTelefono(trim($_POST['telefono']));
            $utente->setRuolo($_POST['ruolo']);
            $utente->setCreditiResidui((int)$_POST['crediti_residui']);
            $utente->setScadenzaCertificato($_POST['scadenza_certificato']);

            FUtente::update($utente);

            header("Location: index.php?controller=admin&action=utenti&msg=" . urlencode("Dati di {$utente->getNome()} {$utente->getCognome()} aggiornati con successo."));
            exit;
        } else {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $utente = FUtente::load($id);
            if (!$utente) {
                header("Location: index.php?controller=admin&action=utenti");
                exit;
            }
            $view->mostraFormUtente($utente);
        }
    }

    // 3. Crea un nuovo utente direttamente dal pannello Admin
    public function creaUtente() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome']);
            $cognome = trim($_POST['cognome']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $telefono = trim($_POST['telefono']);
            $ruolo = $_POST['ruolo'];
            $crediti = (int)$_POST['crediti_residui'];
            $scadenza = !empty($_POST['scadenza_certificato']) ? $_POST['scadenza_certificato'] : null;

            if (FUtente::loadByEmail($email)) {
                $view->mostraFormUtente(null, "Attenzione: esiste già un utente registrato con questa email.");
                return;
            }

            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono, $ruolo, $crediti, $scadenza);
            $id = FUtente::store($nuovoUtente);

            if ($id) {
                // Assicura che ruolo, crediti iniziali e scadenza certificato vengano salvati anche se FUtente::store usa valori di default
                $nuovoUtente->setId($id);
                FUtente::update($nuovoUtente);

                header("Location: index.php?controller=admin&action=utenti&msg=" . urlencode("Nuovo utente ({$nome} {$cognome}) creato con successo."));
                exit;
            } else {
                $view->mostraFormUtente(null, "Errore durante la creazione dell'utente.");
            }
        } else {
            $view->mostraFormUtente(null);
        }
    }
}
?>