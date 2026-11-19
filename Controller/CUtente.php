<?php
// File: Controller/CUtente.php

class CUtente {
    
    // Mostra la home page con l'elenco degli istruttori per il carosello
    public function home() {
        $istruttori_entity = FUtente::loadSoloIstruttori();
        $istruttori_dati = [];

        foreach ($istruttori_entity as $istr) {
            $iniziali = strtoupper(
                substr($istr->getNome(), 0, 1) . substr($istr->getCognome(), 0, 1)
            );

            $istruttori_dati[] = [
                'id' => $istr->getId(),
                'nome' => $istr->getNome(),
                'cognome' => $istr->getCognome(),
                'email' => $istr->getEmail(),
                'iniziali' => $iniziali
            ];
        }

        $view = new VUtente();
        $view->mostraHome($istruttori_dati);
    }

    // Gestione Registrazione
    public function registra() {
        $view = new VUtente();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telefono = $_POST['telefono'];

            // 1. Controllo di sicurezza: verifichiamo che l'email non sia già registrata
            $esiste = FUtente::loadByEmail($email);
            if ($esiste) {
                $view->mostraRegistrazione("Attenzione: questa email è già in uso. Prova ad accedere.");
                return;
            }

            // 2. Crea l'Entity (la password verrà cifrata automaticamente all'interno di FUtente::store che abbiamo scritto prima)
            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono);
            
            // 3. Salva nel Database
            $id = FUtente::store($nuovoUtente);
            
            if ($id) {
                // 4. Avvia la sessione ed esegue il login automatico post-registrazione
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['utente_id'] = $id;
                $_SESSION['ruolo'] = 'allievo'; // Di default i nuovi iscritti sono allievi
                
                // 5. Reindirizza l'utente alla sua nuova Dashboard
                header("Location: index.php?controller=utente&action=dashboard");
                exit;
            } else {
                $view->mostraRegistrazione("Errore imprevisto durante la registrazione. Riprova.");
            }
        } else {
            // Se non è stato inviato alcun form (richiesta GET), mostra la pagina vuota
            $view->mostraRegistrazione();
        }
    }
    
    // Gestione Login
    public function login() {
        $view = new VUtente();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // 1. Recupera l'utente dal database partendo dall'email
            $utente = FUtente::loadByEmail($email);
            
            // 2. Verifica che l'utente esista e che la password coincida
            // password_verify confronta la password in chiaro del form con l'hash salvato nel DB
            if ($utente && password_verify($password, $utente->getPassword())) {
                
                // 3. Login effettuato con successo: avvia la sessione
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                
                // 4. Salva i dati essenziali nel "badge virtuale" della sessione
                $_SESSION['utente_id'] = $utente->getId();
                $_SESSION['ruolo'] = $utente->getRuolo();
                
                // 5. Smistamento in base al ruolo: Admin o Allievo?
                if ($utente->getRuolo() === 'admin') {
                header("Location: index.php?controller=admin&action=dashboard");
                } elseif ($utente->getRuolo() === 'istruttore') {
                header("Location: index.php?controller=istruttore&action=dashboard");
                } else {
                header("Location: index.php?controller=utente&action=dashboard");
                }
                exit;
            } else {
                // Credenziali errate
                $view->mostraLogin("Email o password errati. Riprova.");
            }
        } else {
            $view->mostraLogin();
        }
    }

    // Mostra la dashboard protetta dell'allievo
    public function dashboard() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id'])) {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_utente = (int)$_SESSION['utente_id'];
        $utente = FUtente::load($id_utente);
        if (!$utente) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        // 1. RECUPERIAMO LE PRENOTAZIONI AI CORSI DI GRUPPO DELL'ALLIEVO
        $prenotazioni_entity = FPrenotazione::loadByUtente($id_utente);
        $lista_prenotazioni = [];

        foreach ($prenotazioni_entity as $p) {
            $lezione = FLezione::load($p->getIdLezione());
            if (!$lezione) {
                continue;
            }
            $corso = FCorso::load($lezione->getIdCorso());

            $lista_prenotazioni[] = [
                'id_prenotazione' => $p->getId(),
                'nome_corso' => $corso ? $corso->getNome() : 'Corso',
                'data_ora' => date('d/m/Y H:i', strtotime($lezione->getDataOraInizio()))
            ];
        }

        // 2. CARICA LE LEZIONI INDIVIDUALI DELL'ALLIEVO (prenotate e annullate dall'istruttore)
        $individuali_entity = FLezioneIndividuale::loadByUtente($id_utente);
        $lezioni_individuali_utente = [];
        $oggi = date('Y-m-d H:i:s');

        foreach ($individuali_entity as $slot) {
            // Mostra lezioni future o annullate dall'istruttore
            if ($slot->getDataOraInizio() < $oggi && $slot->getStato() !== 'annullata_istruttore') {
                continue;
            }
            $istruttore = FUtente::load($slot->getIdIstruttore());
            $lezioni_individuali_utente[] = [
                'id' => $slot->getId(),
                'istruttore' => $istruttore ? $istruttore->getNome() . ' ' . $istruttore->getCognome() : 'Istruttore',
                'data' => date('d/m/Y', strtotime($slot->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($slot->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($slot->getDataOraFine())),
                'stato' => $slot->getStato(),
                'motivazione' => $slot->getMotivazioneAnnullamento()
            ];
        }

        $msg = $_GET['msg'] ?? null;
        $err = $_GET['err'] ?? null;

        $view = new VUtente();
        $view->mostraDashboardAllievo($utente, $lista_prenotazioni, $lezioni_individuali_utente, $msg, $err);
    }

    // Gestione Logout
    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Svuota e distrugge la sessione
        session_unset();
        session_destroy();
        
        // Rimanda alla homepage pubblica
        header("Location: index.php?controller=utente&action=home");
        exit;
    }
}
?>