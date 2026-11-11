<?php
// File: Controller/CUtente.php

class CUtente {
    
    // Homepage
    public function home() {
        $view = new VUtente();
        $view->mostraHome();
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Controllo: se non c'è una sessione attiva, caccia via l'utente e rimandalo al login
        if (!isset($_SESSION['utente_id'])) {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        // Recupera i dati freschi dell'utente dal DB
        $id_utente = $_SESSION['utente_id'];
        $utente = FUtente::load($id_utente);
        
        // Passa l'oggetto utente alla View per mostrarlo in Smarty
        $view = new VUtente();
        $view->mostraDashboardAllievo($utente);
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