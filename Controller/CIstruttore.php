<?php
// File: Controller/CIstruttore.php

class CIstruttore {

    // Controllo di sicurezza centralizzato per tutte le azioni dell'istruttore
    private function verificaIstruttore() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utente_id']) || ($_SESSION['ruolo'] ?? '') !== 'istruttore') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }
        return (int)$_SESSION['utente_id'];
    }

    // Dashboard principale: lezioni individuali + corsi di gruppo assegnati
    public function dashboard() {
        $id_istruttore = $this->verificaIstruttore();
        $istruttore = FUtente::load($id_istruttore);
        if (!$istruttore) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }
        $oggi = date('Y-m-d H:i:s');

        // 1. Carica i corsi di gruppo assegnati dall'Admin
        $lezioni_gruppo = FLezione::loadByIstruttore($id_istruttore);
        $corsi_futuri = [];
        $corsi_passati = [];

        foreach ($lezioni_gruppo as $lezione) {
            $corso = FCorso::load($lezione->getIdCorso());
            $prenotazioni = FPrenotazione::loadByLezione($lezione->getId());
            $ts_inizio = strtotime($lezione->getDataOraInizio());
            $ts_fine = strtotime($lezione->getDataOraFine());

            $dati_corso = [
                'id_lezione' => $lezione->getId(),
                'nome_corso' => $corso ? $corso->getNome() : 'Corso',
                'capienza_max' => $corso ? $corso->getCapienzaMax() : 0,
                'num_iscritti' => count($prenotazioni),
                'data_formattata' => date('d/m/Y', $ts_inizio),
                'ora_inizio' => date('H:i', $ts_inizio),
                'ora_fine' => date('H:i', $ts_fine)
            ];

            if ($lezione->getDataOraInizio() >= $oggi) {
                $corsi_futuri[] = $dati_corso;
            } else {
                $corsi_passati[] = $dati_corso;
            }
        }
        $corsi_passati = array_reverse($corsi_passati);

        // 2. Carica gli slot delle lezioni individuali futuri (liberi, prenotati e annullati)
        $slot_entity = FLezioneIndividuale::loadByIstruttore($id_istruttore);
        $lezioni_individuali = [];
        $conteggio_prenotate = 0;
        $conteggio_disponibili = 0;

        foreach ($slot_entity as $slot) {
            if ($slot->getDataOraInizio() < $oggi) {
                continue;
            }

            // Rimuove eventuali vecchi slot liberi che entrano in conflitto con un corso di gruppo assegnato
            if ($slot->getStato() === 'disponibile' && FLezione::hasSovrapposizione($id_istruttore, $slot->getDataOraInizio(), $slot->getDataOraFine())) {
                FLezioneIndividuale::deleteDisponibilita($slot->getId(), $id_istruttore);
                continue;
            }

            $allievo_nome = null;
            $allievo_telefono = null;
            $allievo_email = null;

            if ($slot->getIdUtente()) {
                $allievo = FUtente::load($slot->getIdUtente());
                if ($allievo) {
                    $allievo_nome = $allievo->getNome() . ' ' . $allievo->getCognome();
                    $allievo_telefono = $allievo->getTelefono();
                    $allievo_email = $allievo->getEmail();
                }
            }

            if ($slot->getStato() === 'prenotata') {
                $conteggio_prenotate++;
            } elseif ($slot->getStato() === 'disponibile') {
                $conteggio_disponibili++;
            }

            $lezioni_individuali[] = [
                'id' => $slot->getId(),
                'data_formattata' => date('d/m/Y', strtotime($slot->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($slot->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($slot->getDataOraFine())),
                'stato' => $slot->getStato(),
                'allievo_nome' => $allievo_nome,
                'allievo_telefono' => $allievo_telefono,
                'allievo_email' => $allievo_email,
                'motivazione' => $slot->getMotivazioneAnnullamento()
            ];
        }

        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        $err = isset($_GET['err']) ? $_GET['err'] : null;
        $mostra_avviso_password = (
            $istruttore->deveCambiarePassword()
            && empty($_SESSION['avviso_password_chiuso'])
        );

        $view = new VIstruttore();
        $view->mostraDashboard(
            $istruttore,
            $corsi_futuri,
            $corsi_passati,
            $lezioni_individuali,
            $conteggio_prenotate,
            $conteggio_disponibili,
            $msg,
            $err,
            $mostra_avviso_password
        );
    }

    // Inserisce una fascia oraria dividendola automaticamente in slot da 1 ora
    public function aggiungiDisponibilita() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $data = $_POST['data'] ?? '';
        $ora_inizio = (int)($_POST['ora_inizio'] ?? 0);
        $ora_fine = (int)($_POST['ora_fine'] ?? 0);

        if (empty($data) || $ora_fine <= $ora_inizio) {
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("Seleziona una data valida e un'ora di fine successiva a quella di inizio."));
            exit;
        }

        $inseriti = 0;
        $saltati_corso_gruppo = 0;
        $saltati_individuale = 0;
        $saltati_passati = 0;

        for ($ora = $ora_inizio; $ora < $ora_fine; $ora++) {
            $inizio_slot = sprintf('%s %02d:00:00', $data, $ora);
            $fine_slot = sprintf('%s %02d:00:00', $data, $ora + 1);

            if (strtotime($inizio_slot) <= time()) {
                $saltati_passati++;
                continue;
            }

            if (FLezione::hasSovrapposizione($id_istruttore, $inizio_slot, $fine_slot)) {
                $saltati_corso_gruppo++;
                continue;
            }

            if (FLezioneIndividuale::hasSovrapposizioneIndividuale($id_istruttore, $inizio_slot, $fine_slot)) {
                $saltati_individuale++;
                continue;
            }

            $nuovoSlot = new ELezioneIndividuale($id_istruttore, $inizio_slot, $fine_slot);
            if (FLezioneIndividuale::store($nuovoSlot)) {
                $inseriti++;
            }
        }

        if ($inseriti > 0) {
            $messaggio = "Inseriti {$inseriti} slot di disponibilità da 1 ora.";
            $dettagli = [];
            if ($saltati_corso_gruppo > 0) {
                $dettagli[] = "{$saltati_corso_gruppo} saltati perché sovrapposti a corsi di gruppo assegnati";
            }
            if ($saltati_individuale > 0) {
                $dettagli[] = "{$saltati_individuale} saltati perché già presenti in agenda";
            }
            if (!empty($dettagli)) {
                $messaggio .= " (" . implode('; ', $dettagli) . ").";
            }
            header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode($messaggio));
        } else {
            $errore = "Nessuno slot inserito.";
            if ($saltati_corso_gruppo > 0 && $saltati_individuale === 0) {
                $errore = "Non puoi inserire disponibilità in questa fascia oraria perché sei già assegnato/a a una lezione di gruppo.";
            } elseif ($saltati_corso_gruppo > 0 || $saltati_individuale > 0) {
                $errore = "Tutti gli orari selezionati si sovrappongono a corsi di gruppo assegnati o disponibilità già esistenti.";
            } elseif ($saltati_passati > 0) {
                $errore = "Non è possibile inserire disponibilità in date o orari già trascorsi.";
            }
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode($errore));
        }
        exit;
    }

    // Rimuove uno slot libero non ancora prenotato
    public function rimuoviDisponibilita() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_slot'])) {
            $id_slot = (int)$_POST['id_slot'];
            if (FLezioneIndividuale::deleteDisponibilita($id_slot, $id_istruttore)) {
                header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Disponibilità rimossa dal calendario."));
                exit;
            }
        }

        header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("Impossibile rimuovere lo slot selezionato."));
        exit;
    }

    // Annulla una lezione individuale già prenotata con motivazione (nessuna variazione sui crediti)
    public function annullaIndividuale() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $id_slot = (int)($_POST['id_slot'] ?? 0);
        $motivazione = trim($_POST['motivazione'] ?? '');

        if ($motivazione === '') {
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("Inserisci una motivazione prima di annullare la prenotazione."));
            exit;
        }

        $slot = FLezioneIndividuale::load($id_slot);

        if ($slot && $slot->getIdIstruttore() === $id_istruttore && $slot->getStato() === 'prenotata') {
            $annullata = FLezioneIndividuale::annullaDaIstruttore($id_slot, $id_istruttore, $motivazione);

            if ($annullata) {
                header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Lezione individuale annullata. La motivazione è visibile all'allievo nella propria dashboard."));
                exit;
            }
        }

        header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("Impossibile annullare questa lezione individuale."));
        exit;
    }

    // Appello degli iscritti a un corso di gruppo assegnato all'istruttore
    public function appello() {
        $id_istruttore = $this->verificaIstruttore();
        $id_lezione = isset($_GET['id_lezione']) ? (int)$_GET['id_lezione'] : 0;
        $lezione = FLezione::load($id_lezione);

        if (!$lezione || $lezione->getIdIstruttore() != $id_istruttore) {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $corso = FCorso::load($lezione->getIdCorso());
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
            'capienza_max' => $corso ? $corso->getCapienzaMax() : 0,
            'data' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
            'orario' => date('H:i', strtotime($lezione->getDataOraInizio())) . ' - ' . date('H:i', strtotime($lezione->getDataOraFine()))
        ];

        $view = new VIstruttore();
        $view->mostraAppello($dettagli_lezione, $iscritti);
    }

    // Carica o sostituisce l'immagine profilo dell'istruttore dalla propria dashboard
    public function aggiornaImmagineProfilo() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $istruttore = FUtente::load($id_istruttore);
        if (!$istruttore) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        $esito = UImmagine::salvaImmagineProfilo(
            $_FILES['immagine_profilo'] ?? null,
            $id_istruttore,
            $istruttore->getImmagineProfilo()
        );

        if (!$esito['ok']) {
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode($esito['errore']));
            exit;
        }

        $istruttore->setImmagineProfilo($esito['percorso']);
        FUtente::update($istruttore);

        header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Immagine profilo aggiornata con successo!"));
        exit;
    }

    // Rimuove l'immagine profilo dell'istruttore dalla propria dashboard
    public function rimuoviImmagineProfilo() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $istruttore = FUtente::load($id_istruttore);
        if (!$istruttore) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        if ($istruttore->getImmagineProfilo()) {
            UImmagine::eliminaImmagineProfilo($istruttore->getImmagineProfilo());
            $istruttore->setImmagineProfilo(null);
            FUtente::update($istruttore);
        }

        header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Immagine profilo rimossa."));
        exit;
    }

    // Aggiorna la tariffa oraria dell'istruttore per le lezioni individuali (1-to-1)
    public function aggiornaTariffa() {
        $id_istruttore = $this->verificaIstruttore();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=istruttore&action=dashboard");
            exit;
        }

        $istruttore = FUtente::load($id_istruttore);
        if (!$istruttore) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        $valore_raw = trim(str_replace(',', '.', $_POST['tariffa_individuale'] ?? ''));

        if ($valore_raw === '') {
            $istruttore->setTariffaIndividuale(null);
            FUtente::update($istruttore);
            header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Tariffa individuale rimossa (verrà mostrata come 'Su richiesta')."));
            exit;
        }

        if (!is_numeric($valore_raw)) {
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("Inserisci un importo numerico valido per la tariffa individuale."));
            exit;
        }

        $importo = round((float)$valore_raw, 2);
        if ($importo <= 0 || $importo > 9999.99) {
            header("Location: index.php?controller=istruttore&action=dashboard&err=" . urlencode("La tariffa individuale deve essere compresa tra 1 € e 9999,99 €."));
            exit;
        }

        $istruttore->setTariffaIndividuale($importo);
        FUtente::update($istruttore);

        header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Tariffa per le lezioni individuali aggiornata a {$istruttore->getTariffaFormattata()}!"));
        exit;
    }
}
?>