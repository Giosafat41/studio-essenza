<?php
// File: Controller/CSegretaria.php

class CSegretaria {

    // La segretaria gestisce allievi e istruttori: MAI altri segretari né l'admin
    private const RUOLI_GESTITI = ['allievo', 'istruttore'];

    private function verificaSegretaria() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || ($_SESSION['ruolo'] ?? '') !== 'segretaria') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }
        $segretaria = FUtente::load((int)$_SESSION['utente_id']);
        if (!$segretaria || $segretaria->getRuolo() !== 'segretaria') {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }
        return $segretaria;
    }

    public function dashboard() {
        $segretaria = $this->verificaSegretaria();

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

        $totale_utenti = count(FUtente::loadByRuoli(self::RUOLI_GESTITI));
        $messaggio_errore = $_GET['err'] ?? null;
        $messaggio_successo = $_GET['msg'] ?? null;
        $mostra_avviso_password = (
            $segretaria->deveCambiarePassword()
            && empty($_SESSION['avviso_password_chiuso'])
        );

        $view = new VSegretaria();
        $view->mostraDashboard(
            $segretaria->getNome(),
            $lezioni_disponibili,
            $totale_utenti,
            $messaggio_errore,
            $messaggio_successo,
            $mostra_avviso_password
        );
    }

    // =========================================================================
    // GESTIONE UTENTI (solo Allievi e Istruttori; altri segretari e admin invisibili)
    // =========================================================================

    public function utenti() {
        $this->verificaSegretaria();

        $utenti = FUtente::loadByRuoli(self::RUOLI_GESTITI);
        $messaggio = $_GET['msg'] ?? null;
        $errore = $_GET['err'] ?? null;

        $view = new VSegretaria();
        $view->mostraUtenti($utenti, $messaggio, $errore);
    }

    public function modificaUtente() {
        $this->verificaSegretaria();
        $view = new VSegretaria();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $utente = FUtente::load($id);

            // Impedisce di visualizzare o modificare profili segretaria o admin
            if (!$utente || !in_array($utente->getRuolo(), self::RUOLI_GESTITI, true)) {
                header("Location: index.php?controller=segretaria&action=utenti&err=" . urlencode("Non sei autorizzato a modificare questo profilo."));
                exit;
            }

            $nuova_email = trim($_POST['email'] ?? '');
            $esistente = FUtente::loadByEmail($nuova_email);
            if ($esistente && $esistente->getId() != $id) {
                $view->mostraFormUtente($utente, "Errore: l'email inserita è già utilizzata da un altro utente.");
                return;
            }

            $ruolo = $_POST['ruolo'] ?? '';
            if (!in_array($ruolo, self::RUOLI_GESTITI, true)) {
                $view->mostraFormUtente($utente, "Ruolo non consentito. Puoi gestire solo Allievi e Istruttori.");
                return;
            }

            $utente->setNome(trim($_POST['nome'] ?? ''));
            $utente->setCognome(trim($_POST['cognome'] ?? ''));
            $utente->setEmail($nuova_email);
            $utente->setTelefono(trim($_POST['telefono'] ?? ''));
            $utente->setRuolo($ruolo);

            if ($ruolo === 'allievo') {
                $utente->setCreditiResidui(isset($_POST['crediti_residui']) ? max(0, (int)$_POST['crediti_residui']) : 0);
                $utente->setScadenzaCertificato(!empty($_POST['scadenza_certificato']) ? $_POST['scadenza_certificato'] : null);
                $utente->setDescrizione(null);
                $utente->setTariffaIndividuale(null);
            } else {
                // istruttore
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
            }

            FUtente::update($utente);

            header("Location: index.php?controller=segretaria&action=utenti&msg=" . urlencode("Dati di {$utente->getNome()} {$utente->getCognome()} aggiornati con successo."));
            exit;
        } else {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $utente = FUtente::load($id);
            if (!$utente || !in_array($utente->getRuolo(), self::RUOLI_GESTITI, true)) {
                header("Location: index.php?controller=segretaria&action=utenti&err=" . urlencode("Profilo non trovato o non accessibile."));
                exit;
            }
            $view->mostraFormUtente($utente);
        }
    }

    public function creaUtente() {
        $this->verificaSegretaria();
        $view = new VSegretaria();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $cognome = trim($_POST['cognome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if ($password === '') {
                $password = CAdmin::generaPasswordIniziale($nome, $cognome);
            }
            if ($password === '') {
                $view->mostraFormUtente(null, "Imposta una password iniziale valida per il nuovo utente.");
                return;
            }
            $telefono = trim($_POST['telefono'] ?? '');
            $ruolo = $_POST['ruolo'] ?? '';

            if (!in_array($ruolo, self::RUOLI_GESTITI, true)) {
                $view->mostraFormUtente(null, "Ruolo non consentito. Puoi creare solo profili Allievo o Istruttore.");
                return;
            }

            $tariffa_individuale = null;
            if ($ruolo === 'allievo') {
                $crediti = isset($_POST['crediti_residui']) ? max(0, (int)$_POST['crediti_residui']) : 0;
                $scadenza = !empty($_POST['scadenza_certificato']) ? $_POST['scadenza_certificato'] : null;
                $descrizione = null;
            } else {
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
            }

            if (FUtente::loadByEmail($email)) {
                $view->mostraFormUtente(null, "Attenzione: esiste già un utente registrato con questa email.");
                return;
            }

            $haUploadIstruttore = ($ruolo === 'istruttore' && UImmagine::hasUpload($_FILES['immagine_profilo'] ?? null));
            if ($haUploadIstruttore) {
                $checkImg = UImmagine::validaUpload($_FILES['immagine_profilo']);
                if (!$checkImg['ok']) {
                    $view->mostraFormUtente(null, $checkImg['errore']);
                    return;
                }
            }

            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono, $ruolo, $crediti, $scadenza, $descrizione, null, $tariffa_individuale, true);
            $id = FUtente::store($nuovoUtente);

            if ($id) {
                $nuovoUtente->setId($id);
                if ($haUploadIstruttore) {
                    $esitoImg = UImmagine::salvaImmagineProfilo($_FILES['immagine_profilo'], (int)$id);
                    if ($esitoImg['ok']) {
                        $nuovoUtente->setImmagineProfilo($esitoImg['percorso']);
                        FUtente::update($nuovoUtente);
                    }
                }

                header("Location: index.php?controller=segretaria&action=utenti&msg=" . urlencode("Nuovo utente ({$nome} {$cognome}) creato con successo. Password iniziale: {$password}"));
                exit;
            } else {
                $view->mostraFormUtente(null, "Errore durante la creazione dell'utente.");
            }
        } else {
            $view->mostraFormUtente(null);
        }
    }

    // =========================================================================
    // GESTIONE LEZIONI ESISTENTI (appello, disiscrizione, cambio istruttore)
    // =========================================================================

    public function appello() {
        $this->verificaSegretaria();

        $id_lezione = isset($_GET['id_lezione']) ? (int)$_GET['id_lezione'] : 0;
        if ($id_lezione <= 0) {
            header("Location: index.php?controller=segretaria&action=dashboard&err=" . urlencode("Seleziona una lezione valida per visualizzare e gestire il registro."));
            exit;
        }

        $lezione = FLezione::load($id_lezione);
        if (!$lezione) {
            header("Location: index.php?controller=segretaria&action=dashboard&err=" . urlencode("La lezione selezionata non è stata trovata."));
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
                    'id_prenotazione' => $p->getId(),
                    'nome' => $allievo->getNome(),
                    'cognome' => $allievo->getCognome(),
                    'email' => $allievo->getEmail(),
                    'telefono' => $allievo->getTelefono(),
                    'certificato_valido' => $allievo->haCertificatoValido($lezione->getDataOraInizio())
                ];
            }
        }

        $dettagli_lezione = [
            'id' => $lezione->getId(),
            'id_istruttore' => (int)$lezione->getIdIstruttore(),
            'nome_corso' => $corso ? $corso->getNome() : 'Corso',
            'istruttore' => $istruttore ? ($istruttore->getNome() . ' ' . $istruttore->getCognome()) : 'Istruttore',
            'data' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
            'orario' => date('H:i', strtotime($lezione->getDataOraInizio())) . ' - ' . date('H:i', strtotime($lezione->getDataOraFine())),
            'capienza_max' => $corso ? (int)$corso->getCapienzaMax() : 0
        ];

        $istruttori = FUtente::loadSoloIstruttori();

        $view = new VSegretaria();
        $view->mostraAppello(
            $dettagli_lezione,
            $iscritti,
            $istruttori,
            $_GET['msg'] ?? null,
            $_GET['err'] ?? null
        );
    }

    public function disiscriviAllievo() {
        $this->verificaSegretaria();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=segretaria&action=dashboard");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $id_prenotazione = (int)($_POST['id_prenotazione'] ?? 0);
        $prenotazione = FPrenotazione::load($id_prenotazione);

        if (!$prenotazione || (int)$prenotazione->getIdLezione() !== $id_lezione) {
            header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Prenotazione non trovata."));
            exit;
        }

        $allievo = FUtente::load($prenotazione->getIdUtente());
        FPrenotazione::delete($id_prenotazione);
        if ($allievo) {
            $allievo->ricaricaCrediti(1);
            FUtente::update($allievo);
            $nome_allievo = $allievo->getNome() . ' ' . $allievo->getCognome();
        } else {
            $nome_allievo = 'Allievo';
        }

        header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("{$nome_allievo} è stato disiscritto dalla lezione (1 credito riaccreditato)."));
        exit;
    }

    public function cambiaIstruttoreLezione() {
        $this->verificaSegretaria();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=segretaria&action=dashboard");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $nuovo_id_istruttore = (int)($_POST['id_istruttore'] ?? 0);
        $lezione = FLezione::load($id_lezione);

        if (!$lezione) {
            header("Location: index.php?controller=segretaria&action=dashboard&err=" . urlencode("Lezione non trovata."));
            exit;
        }

        $nuovoIstruttore = FUtente::load($nuovo_id_istruttore);
        if (!$nuovoIstruttore || $nuovoIstruttore->getRuolo() !== 'istruttore') {
            header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Seleziona un istruttore valido."));
            exit;
        }

        if ((int)$lezione->getIdIstruttore() === $nuovo_id_istruttore) {
            header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("L'istruttore selezionato è già assegnato a questa lezione."));
            exit;
        }

        if (FLezione::hasSovrapposizione($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine(), $id_lezione)) {
            header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Impossibile cambiare istruttore: {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()} è già assegnato a un'altra lezione di gruppo in questa fascia oraria."));
            exit;
        }

        $prenotate_conflitto = FLezioneIndividuale::findPrenotateSovrapposte($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine());
        if (!empty($prenotate_conflitto)) {
            header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Impossibile cambiare istruttore: {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()} ha già una lezione individuale prenotata in questa fascia oraria."));
            exit;
        }

        FLezione::updateIstruttore($id_lezione, $nuovo_id_istruttore);
        FLezioneIndividuale::rimuoviDisponibiliSovrapposte($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine());

        header("Location: index.php?controller=segretaria&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("Istruttore aggiornato a {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()}."));
        exit;
    }
}
?>
