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
        if (!$admin) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        // Carica tutte le lezioni disponibili (non scadute) per il menù a tendina del Registro Appello
        $lezioni_entity = FLezione::loadDisponibili();
        $lezioni_disponibili = [];

        foreach ($lezioni_entity as $lezione) {
            $corso = FCorso::load($lezione->getIdCorso());
            $istruttore = FUtente::load($lezione->getIdIstruttore());
            $prenotazioni = FPrenotazione::loadByLezione($lezione->getId());

            $lezioni_disponibili[] = [
                'id' => $lezione->getId(),
                'nome_corso' => $corso ? $corso->getNome() : 'Corso',
                'istruttore' => $istruttore ? ($istruttore->getNome() . ' ' . $istruttore->getCognome()) : 'Istruttore',
                'data' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($lezione->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($lezione->getDataOraFine())),
                'num_iscritti' => count($prenotazioni),
                'capienza_max' => $corso ? (int)$corso->getCapienzaMax() : 0
            ];
        }

        $totale_utenti = count(FUtente::loadAll());
        $messaggio_errore = isset($_GET['err']) ? $_GET['err'] : null;

        $view = new VAdmin();
        $view->mostraDashboard(
            $admin->getNome(),
            $lezioni_disponibili,
            $totale_utenti,
            $messaggio_errore
        );
    }


    // Gestione Creazione Nuova Lezione
    public function aggiungiLezione() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $view = new VAdmin();
        $corsi = FCorso::loadAll();
        $istruttori = FUtente::loadIstruttori();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_corso = (int)$_POST['id_corso'];
            $id_istruttore = (int)$_POST['id_istruttore'];
            // Converte le date dal form HTML nel formato MySQL (YYYY-MM-DD HH:MM:SS)
            $data_inizio = str_replace('T', ' ', $_POST['data_ora_inizio']) . ':00';
            $data_fine = str_replace('T', ' ', $_POST['data_ora_fine']) . ':00';

            if (strtotime($data_fine) <= strtotime($data_inizio)) {
                $view->mostraFormLezione($corsi, $istruttori, null, "L'orario di fine deve essere successivo a quello di inizio.");
                return;
            }

            $lezione = new ELezione($id_corso, $id_istruttore, $data_inizio, $data_fine);
            FLezione::store($lezione);

            $view->mostraFormLezione($corsi, $istruttori, "Lezione inserita con successo nel palinsesto!");
        } else {
            // Se la richiesta è GET, carichiamo i dati per i menu a tendina
            $view->mostraFormLezione($corsi, $istruttori);
        }
    }
    
    // Mostra l'appello per una specifica lezione
    public function appello() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SESSION['ruolo'] !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_lezione = isset($_GET['id_lezione']) ? (int)$_GET['id_lezione'] : 0;
        if ($id_lezione <= 0) {
            header("Location: index.php?controller=admin&action=dashboard&err=" . urlencode("Seleziona una lezione valida per visualizzare il registro appello."));
            exit;
        }

        $lezione = FLezione::load($id_lezione);
        if (!$lezione) {
            header("Location: index.php?controller=admin&action=dashboard&err=" . urlencode("La lezione selezionata non è stata trovata."));
            exit;
        }

        $corso = FCorso::load($lezione->getIdCorso());
        $istruttore = FUtente::load($lezione->getIdIstruttore());
        $prenotazioni = FPrenotazione::loadByLezione($id_lezione);

        $iscritti = [];
        foreach ($prenotazioni as $p) {
            $allievo = FUtente::load($p->getIdUtente());
            if ($allievo) {
                $iscritti[] = [
                    'nome' => $allievo->getNome(),
                    'cognome' => $allievo->getCognome(),
                    'email' => $allievo->getEmail(),
                    'telefono' => $allievo->getTelefono(),
                    'certificato_valido' => $allievo->haCertificatoValido($lezione->getDataOraInizio())
                ];
            }
        }

        $dettagli_lezione = [
            'nome_corso' => $corso ? $corso->getNome() : 'Corso',
            'istruttore' => $istruttore ? ($istruttore->getNome() . ' ' . $istruttore->getCognome()) : 'Istruttore',
            'data' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
            'orario' => date('H:i', strtotime($lezione->getDataOraInizio())) . ' - ' . date('H:i', strtotime($lezione->getDataOraFine())),
            'capienza_max' => $corso ? (int)$corso->getCapienzaMax() : 0
        ];

        $view = new VAdmin();
        $view->mostraAppello($dettagli_lezione, $iscritti);
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
} //
?>