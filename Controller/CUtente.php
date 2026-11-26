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
                'iniziali' => $iniziali,
                'descrizione' => $istr->getDescrizione(),
                'immagine_profilo' => $istr->getImmagineProfilo()
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
                // Ad ogni nuovo accesso l'eventuale avviso di cambio password torna visibile finché non viene cambiata
                unset($_SESSION['avviso_password_chiuso']);
                
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
                'tariffa_formattata' => $istruttore ? $istruttore->getTariffaFormattata() : null,
                'data' => date('d/m/Y', strtotime($slot->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($slot->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($slot->getDataOraFine())),
                'stato' => $slot->getStato(),
                'motivazione' => $slot->getMotivazioneAnnullamento()
            ];
        }

        $msg = $_GET['msg'] ?? null;
        $err = $_GET['err'] ?? null;
        $mostra_avviso_password = (
            $utente->getRuolo() !== 'admin'
            && $utente->deveCambiarePassword()
            && empty($_SESSION['avviso_password_chiuso'])
        );

        $view = new VUtente();
        $view->mostraDashboardAllievo(
            $utente,
            $lista_prenotazioni,
            $lezioni_individuali_utente,
            $msg,
            $err,
            $mostra_avviso_password
        );
    }

    // Restituisce l'URL della dashboard corrispondente al ruolo dell'utente
    private function getDashboardUrlByRuolo(string $ruolo): string {
        if ($ruolo === 'admin') {
            return 'index.php?controller=admin&action=dashboard';
        }
        if ($ruolo === 'istruttore') {
            return 'index.php?controller=istruttore&action=dashboard';
        }
        return 'index.php?controller=utente&action=dashboard';
    }

    // Chiude temporaneamente l'avviso di cambio password per la sessione corrente
    public function chiudiAvvisoPassword() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id'])) {
            http_response_code(401);
            exit;
        }

        $_SESSION['avviso_password_chiuso'] = true;

        $isAjax = (
            (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
            || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        );

        if ($isAjax) {
            http_response_code(204);
            exit;
        }

        header("Location: " . $this->getDashboardUrlByRuolo($_SESSION['ruolo'] ?? 'allievo'));
        exit;
    }

    // Pagina e salvataggio cambio password per allievo, istruttore e admin
    public function cambiaPassword() {
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

        $url_ritorno = $this->getDashboardUrlByRuolo($utente->getRuolo());
        $avviso_attivo = ($utente->getRuolo() !== 'admin' && $utente->deveCambiarePassword());
        $view = new VUtente();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password_attuale = $_POST['password_attuale'] ?? '';
            $nuova_password = $_POST['nuova_password'] ?? '';
            $conferma_password = $_POST['conferma_password'] ?? '';

            if ($password_attuale === '' || $nuova_password === '' || $conferma_password === '') {
                $view->mostraCambiaPassword($url_ritorno, $avviso_attivo, "Compila tutti i campi richiesti.");
                return;
            }

            if (!password_verify($password_attuale, $utente->getPassword())) {
                $view->mostraCambiaPassword($url_ritorno, $avviso_attivo, "La password attuale inserita non è corretta.");
                return;
            }

            if (strlen($nuova_password) < 6) {
                $view->mostraCambiaPassword($url_ritorno, $avviso_attivo, "La nuova password deve contenere almeno 6 caratteri.");
                return;
            }

            if ($nuova_password !== $conferma_password) {
                $view->mostraCambiaPassword($url_ritorno, $avviso_attivo, "La nuova password e la conferma non coincidono.");
                return;
            }

            if (password_verify($nuova_password, $utente->getPassword())) {
                $view->mostraCambiaPassword($url_ritorno, $avviso_attivo, "Scegli una nuova password diversa da quella attuale.");
                return;
            }

            FUtente::updatePassword($id_utente, $nuova_password, false);
            unset($_SESSION['avviso_password_chiuso']);

            header("Location: {$url_ritorno}&msg=" . urlencode("Password aggiornata con successo!"));
            exit;
        }

        $view->mostraCambiaPassword($url_ritorno, $avviso_attivo);
    }

    // Carica o sostituisce l'immagine profilo dell'allievo dalla propria dashboard
    public function aggiornaImmagineProfilo() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_utente = (int)$_SESSION['utente_id'];
        $utente = FUtente::load($id_utente);
        if (!$utente) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        $esito = UImmagine::salvaImmagineProfilo(
            $_FILES['immagine_profilo'] ?? null,
            $id_utente,
            $utente->getImmagineProfilo()
        );

        if (!$esito['ok']) {
            header("Location: index.php?controller=utente&action=dashboard&err=" . urlencode($esito['errore']));
            exit;
        }

        $utente->setImmagineProfilo($esito['percorso']);
        FUtente::update($utente);

        header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Immagine profilo aggiornata con successo!"));
        exit;
    }

    // Rimuove l'immagine profilo dell'allievo dalla propria dashboard
    public function rimuoviImmagineProfilo() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_utente = (int)$_SESSION['utente_id'];
        $utente = FUtente::load($id_utente);
        if (!$utente) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        if ($utente->getImmagineProfilo()) {
            UImmagine::eliminaImmagineProfilo($utente->getImmagineProfilo());
            $utente->setImmagineProfilo(null);
            FUtente::update($utente);
        }

        header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Immagine profilo rimossa."));
        exit;
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