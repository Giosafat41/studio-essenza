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
            $id_corso = (int)($_POST['id_corso'] ?? 0);
            $id_istruttore = (int)($_POST['id_istruttore'] ?? 0);
            $inizio_raw = trim($_POST['data_ora_inizio'] ?? '');
            $durata_minuti = (int)($_POST['durata_minuti'] ?? 0);

            $ts_inizio = strtotime(str_replace('T', ' ', $inizio_raw));
            if ($id_corso <= 0 || $id_istruttore <= 0 || $inizio_raw === '' || $ts_inizio === false) {
                $view->mostraFormLezione($corsi, $istruttori, null, "Compila correttamente corso, istruttore e data/ora di inizio.");
                return;
            }

            if ($durata_minuti < 30 || $durata_minuti > 360 || ($durata_minuti % 30) !== 0) {
                $view->mostraFormLezione($corsi, $istruttori, null, "Seleziona una durata valida a blocchi di 30 minuti.");
                return;
            }

            $data_inizio = date('Y-m-d H:i:s', $ts_inizio);
            $data_fine = date('Y-m-d H:i:s', $ts_inizio + ($durata_minuti * 60));

            // 1. Verifica che l'istruttore non sia già assegnato a un'altra lezione di gruppo nella stessa fascia oraria
            if (FLezione::hasSovrapposizione($id_istruttore, $data_inizio, $data_fine)) {
                $view->mostraFormLezione(
                    $corsi,
                    $istruttori,
                    null,
                    "Impossibile salvare: l'istruttore selezionato è già assegnato a un'altra lezione di gruppo in questa fascia oraria."
                );
                return;
            }

            // 2. Verifica se l'istruttore ha già lezioni individuali PRENOTATE da allievi in questa fascia oraria
            $prenotate_conflitto = FLezioneIndividuale::findPrenotateSovrapposte($id_istruttore, $data_inizio, $data_fine);
            if (!empty($prenotate_conflitto)) {
                $fasce = [];
                foreach ($prenotate_conflitto as $slot) {
                    $fasce[] = date('H:i', strtotime($slot->getDataOraInizio())) . '-' . date('H:i', strtotime($slot->getDataOraFine()));
                }
                $view->mostraFormLezione(
                    $corsi,
                    $istruttori,
                    null,
                    "Impossibile salvare: l'istruttore ha già una lezione individuale prenotata da un allievo in questa fascia oraria (" . implode(', ', $fasce) . ")."
                );
                return;
            }

            // 3. Salva la nuova lezione di gruppo
            $lezione = new ELezione($id_corso, $id_istruttore, $data_inizio, $data_fine, $durata_minuti);
            FLezione::store($lezione);

            // 4. Aggiorna le disponibilità individuali dell'istruttore rimuovendo eventuali slot liberi sovrapposti
            $slot_rimossi = FLezioneIndividuale::rimuoviDisponibiliSovrapposte($id_istruttore, $data_inizio, $data_fine);

            $messaggio = "Lezione inserita con successo nel palinsesto (" . date('d/m/Y H:i', $ts_inizio) . " - " . date('H:i', $ts_inizio + ($durata_minuti * 60)) . ").";
            if ($slot_rimossi > 0) {
                $label_slot = ($slot_rimossi === 1) ? "1 slot di disponibilità individuale sovrapposto" : "{$slot_rimossi} slot di disponibilità individuale sovrapposti";
                $messaggio .= " Rimosso automaticamente {$label_slot} dall'agenda dell'istruttore.";
            }

            $view->mostraFormLezione($corsi, $istruttori, $messaggio);
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

            $ruolo = $_POST['ruolo'];
            $utente->setNome(trim($_POST['nome']));
            $utente->setCognome(trim($_POST['cognome']));
            $utente->setEmail($nuova_email);
            $utente->setTelefono(trim($_POST['telefono']));
            $utente->setRuolo($ruolo);
            if ($ruolo === 'allievo') {
                $utente->setCreditiResidui(isset($_POST['crediti_residui']) ? max(0, (int)$_POST['crediti_residui']) : 0);
                $utente->setScadenzaCertificato(!empty($_POST['scadenza_certificato']) ? $_POST['scadenza_certificato'] : null);
                $utente->setDescrizione(null);
                $utente->setTariffaIndividuale(null);
                // L'admin non carica né rimuove l'immagine profilo dell'allievo: conserva quella attuale
            } elseif ($ruolo === 'istruttore') {
                $utente->setCreditiResidui(0);
                $utente->setScadenzaCertificato(null);
                $desc = trim($_POST['descrizione'] ?? '');
                $utente->setDescrizione($desc !== '' ? $desc : null);

                $tariffa_raw = trim(str_replace(',', '.', $_POST['tariffa_individuale'] ?? ''));
                if ($tariffa_raw === '') {
                    $utente->setTariffaIndividuale(null);
                } elseif (is_numeric($tariffa_raw) && (float)$tariffa_raw > 0 && (float)$tariffa_raw <= 9999.99) {
                    $utente->setTariffaIndividuale(round((float)$tariffa_raw, 2));
                } else {
                    $view->mostraFormUtente($utente, "Inserisci una tariffa individuale valida (oppure lascia il campo vuoto).");
                    return;
                }

                if (UImmagine::hasUpload($_FILES['immagine_profilo'] ?? null)) {
                    $esitoImg = UImmagine::salvaImmagineProfilo(
                        $_FILES['immagine_profilo'],
                        $utente->getId(),
                        $utente->getImmagineProfilo()
                    );
                    if (!$esitoImg['ok']) {
                        $view->mostraFormUtente($utente, $esitoImg['errore']);
                        return;
                    }
                    $utente->setImmagineProfilo($esitoImg['percorso']);
                } elseif (!empty($_POST['rimuovi_immagine'])) {
                    UImmagine::eliminaImmagineProfilo($utente->getImmagineProfilo());
                    $utente->setImmagineProfilo(null);
                }
            } else {
                $utente->setCreditiResidui(0);
                $utente->setScadenzaCertificato(null);
                $utente->setDescrizione(null);
                $utente->setTariffaIndividuale(null);
                if ($utente->getImmagineProfilo()) {
                    UImmagine::eliminaImmagineProfilo($utente->getImmagineProfilo());
                    $utente->setImmagineProfilo(null);
                }
            }

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
            $tariffa_individuale = null;
            if ($ruolo === 'allievo') {
                $crediti = isset($_POST['crediti_residui']) ? max(0, (int)$_POST['crediti_residui']) : 0;
                $scadenza = !empty($_POST['scadenza_certificato']) ? $_POST['scadenza_certificato'] : null;
                $descrizione = null;
            } elseif ($ruolo === 'istruttore') {
                $crediti = 0;
                $scadenza = null;
                $desc = trim($_POST['descrizione'] ?? '');
                $descrizione = $desc !== '' ? $desc : null;

                $tariffa_raw = trim(str_replace(',', '.', $_POST['tariffa_individuale'] ?? ''));
                if ($tariffa_raw !== '') {
                    if (!is_numeric($tariffa_raw) || (float)$tariffa_raw <= 0 || (float)$tariffa_raw > 9999.99) {
                        $view->mostraFormUtente(null, "Inserisci una tariffa individuale valida (oppure lascia il campo vuoto).");
                        return;
                    }
                    $tariffa_individuale = round((float)$tariffa_raw, 2);
                }
            } else {
                $crediti = 0;
                $scadenza = null;
                $descrizione = null;
            }

            if (FUtente::loadByEmail($email)) {
                $view->mostraFormUtente(null, "Attenzione: esiste già un utente registrato con questa email.");
                return;
            }

            // Se l'admin carica un'immagine per il nuovo istruttore, validala prima di salvare l'utente
            $haUploadIstruttore = ($ruolo === 'istruttore' && UImmagine::hasUpload($_FILES['immagine_profilo'] ?? null));
            if ($haUploadIstruttore) {
                $checkImg = UImmagine::validaUpload($_FILES['immagine_profilo']);
                if (!$checkImg['ok']) {
                    $view->mostraFormUtente(null, $checkImg['errore']);
                    return;
                }
            }

            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono, $ruolo, $crediti, $scadenza, $descrizione, null, $tariffa_individuale);
            $id = FUtente::store($nuovoUtente);

            if ($id) {
                $nuovoUtente->setId($id);
                if ($haUploadIstruttore) {
                    $esitoImg = UImmagine::salvaImmagineProfilo($_FILES['immagine_profilo'], (int)$id);
                    if ($esitoImg['ok']) {
                        $nuovoUtente->setImmagineProfilo($esitoImg['percorso']);
                    }
                }
                // Assicura che tutti i campi (inclusa eventuale immagine profilo) siano aggiornati
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