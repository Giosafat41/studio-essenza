<?php
// File: Controller/CPrenotazione.php

class CPrenotazione {

    // Mostra il calendario delle lezioni di gruppo e gli slot per le lezioni individuali
    public function calendario() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
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

        // 1. Corsi di gruppo nei prossimi 7 giorni
        $oggi = date('Y-m-d H:i:s');
        $prossimaSettimana = date('Y-m-d H:i:s', strtotime('+7 days'));
        $lezioni_entity = FLezione::loadByDateRange($oggi, $prossimaSettimana);

        $lezioni_corsi = [];
        foreach ($lezioni_entity as $lezione) {
            $corso = FCorso::load($lezione->getIdCorso());
            $istruttore = FUtente::load($lezione->getIdIstruttore());
            $prenotazioni = FPrenotazione::loadByLezione($lezione->getId());

            $gia_prenotata = false;
            foreach ($prenotazioni as $p) {
                if ((int)$p->getIdUtente() === $id_utente) {
                    $gia_prenotata = true;
                    break;
                }
            }

            $lezioni_corsi[] = [
                'id' => $lezione->getId(),
                'nome_corso' => $corso ? $corso->getNome() : 'Corso',
                'istruttore' => $istruttore ? $istruttore->getNome() . ' ' . $istruttore->getCognome() : 'Istruttore',
                'data' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($lezione->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($lezione->getDataOraFine())),
                'posti_occupati' => count($prenotazioni),
                'capienza_max' => $corso ? (int)$corso->getCapienzaMax() : 0,
                'gia_prenotata' => $gia_prenotata
            ];
        }

        // 2. Istruttori e relativi slot individuali futuri per il mini-calendario JS
        $giorni_it = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
        $istruttori_entity = FUtente::loadSoloIstruttori();
        $istruttori_lista = [];
        $slot_per_istruttore = [];

        foreach ($istruttori_entity as $istr) {
            $id_istr = (int)$istr->getId();
            $slot_disponibili = FLezioneIndividuale::loadDisponibiliByIstruttore($id_istr);
            $iniziali = strtoupper(
                substr($istr->getNome(), 0, 1) . substr($istr->getCognome(), 0, 1)
            );

            $istruttori_lista[] = [
                'id' => $id_istr,
                'nome' => $istr->getNome(),
                'cognome' => $istr->getCognome(),
                'iniziali' => $iniziali,
                'immagine_profilo' => $istr->getImmagineProfilo(),
                'tariffa_individuale' => $istr->getTariffaIndividuale(),
                'tariffa_formattata' => $istr->getTariffaFormattata(),
                'totale_slot' => count($slot_disponibili)
            ];

            $giorni_raggruppati = [];
            foreach ($slot_disponibili as $slot) {
                $ts_inizio = strtotime($slot->getDataOraInizio());
                $ts_fine = strtotime($slot->getDataOraFine());
                $data_chiave = date('Y-m-d', $ts_inizio);

                if (!isset($giorni_raggruppati[$data_chiave])) {
                    $giorni_raggruppati[$data_chiave] = [
                        'giorno_settimana' => $giorni_it[(int)date('w', $ts_inizio)],
                        'data_label' => date('d/m', $ts_inizio),
                        'orari' => []
                    ];
                }

                $giorni_raggruppati[$data_chiave]['orari'][] = [
                    'id_slot' => $slot->getId(),
                    'ora_inizio' => date('H:i', $ts_inizio),
                    'ora_fine' => date('H:i', $ts_fine)
                ];
            }

            $slot_per_istruttore[(string)$id_istr] = array_values($giorni_raggruppati);
        }

        $slot_individuali_json = json_encode(
            (object)$slot_per_istruttore,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );

        $view = new VPrenotazione();
        $view->mostraCalendario(
            $lezioni_corsi,
            $istruttori_lista,
            $slot_individuali_json,
            (int)$utente->getCreditiResidui(),
            $utente->haCertificatoValido()
        );
    }

    // Gestisce il click sul pulsante "Prenota" per una lezione di gruppo
    public function prenota() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $id_utente = (int)$_SESSION['utente_id'];

        $utente = FUtente::load($id_utente);
        $lezione = FLezione::load($id_lezione);
        $view = new VPrenotazione();

        if (!$utente) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        if (!$lezione) {
            $view->mostraErrore("La lezione selezionata non esiste o non è più disponibile.");
            return;
        }

        // Controllo capienza massima del corso
        $corso = FCorso::load($lezione->getIdCorso());
        if ($corso && count(FPrenotazione::loadByLezione($id_lezione)) >= (int)$corso->getCapienzaMax()) {
            $view->mostraErrore("Spiacenti, questa lezione ha già raggiunto il numero massimo di partecipanti.");
            return;
        }

        // 1. Controllo Certificato Medico
        if (empty($utente->getScadenzaCertificato())) {
            $view->mostraErrore("Prenotazione bloccata: non risulta alcun certificato medico associato al tuo profilo. Consegnalo in segreteria.");
            return;
        }

        if (!$utente->haCertificatoValido($lezione->getDataOraInizio())) {
            $scadenza_formattata = date('d/m/Y', strtotime($utente->getScadenzaCertificato()));
            $view->mostraErrore("Prenotazione bloccata: il tuo certificato medico scade il {$scadenza_formattata}. Passa in segreteria per il rinnovo.");
            return;
        }

        // 2. Controllo Crediti Residui
        if ($utente->getCreditiResidui() <= 0) {
            $view->mostraErrore("Crediti esauriti. Non puoi prenotare questa lezione. Passa in segreteria.");
            return;
        }

        // 3. Salvataggio prenotazione e decurtazione credito
        $prenotazione = new EPrenotazione($id_utente, $id_lezione);

        try {
            $esito = FPrenotazione::store($prenotazione);
            if ($esito) {
                $utente->scalaCredito();
                FUtente::update($utente);

                header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Lezione di gruppo prenotata con successo!"));
                exit;
            } else {
                $view->mostraErrore("Errore durante il salvataggio della prenotazione. Riprova.");
            }
        } catch (Exception $e) {
            $view->mostraErrore("Hai già prenotato questa lezione!");
        }
    }

    // Disdice una lezione di gruppo e rimborsa 1 credito
    public function cancella() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_prenotazione = (int)($_POST['id_prenotazione'] ?? 0);
        $prenotazione = FPrenotazione::load($id_prenotazione);

        if ($prenotazione && (int)$prenotazione->getIdUtente() === (int)$_SESSION['utente_id']) {
            FPrenotazione::delete($id_prenotazione);

            $utente = FUtente::load((int)$_SESSION['utente_id']);
            if ($utente) {
                $utente->ricaricaCrediti(1);
                FUtente::update($utente);
            }
            header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Prenotazione disdetta. 1 credito è stato rimborsato sul tuo profilo."));
            exit;
        }

        header("Location: index.php?controller=utente&action=dashboard");
        exit;
    }

    // Reindirizza al calendario unificato (corsi di gruppo + lezioni individuali)
    public function individuali() {
        header("Location: index.php?controller=prenotazione&action=calendario");
        exit;
    }

    // Gestisce la prenotazione di uno slot individuale da 1 ora
    public function prenotaIndividuale() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_slot = (int)($_POST['id_slot'] ?? 0);
        $id_utente = (int)$_SESSION['utente_id'];

        $utente = FUtente::load($id_utente);
        $slot = FLezioneIndividuale::load($id_slot);
        $view = new VPrenotazione();

        if (!$utente) {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }

        if (
            !$slot
            || $slot->getStato() !== 'disponibile'
            || strtotime($slot->getDataOraInizio()) <= time()
            || FLezione::hasSovrapposizione($slot->getIdIstruttore(), $slot->getDataOraInizio(), $slot->getDataOraFine())
        ) {
            $view->mostraErrore("Questo orario non è più disponibile. Scegli un altro slot dal calendario.");
            return;
        }

        // 1. Controllo Certificato Medico
        if (empty($utente->getScadenzaCertificato())) {
            $view->mostraErrore("Prenotazione bloccata: non risulta alcun certificato medico associato al tuo profilo. Consegnalo in segreteria.");
            return;
        }

        if (!$utente->haCertificatoValido($slot->getDataOraInizio())) {
            $scadenza_formattata = date('d/m/Y', strtotime($utente->getScadenzaCertificato()));
            $view->mostraErrore("Prenotazione bloccata: il tuo certificato medico scade il {$scadenza_formattata}. Passa in segreteria per il rinnovo.");
            return;
        }

        // 2. Prenotazione atomica dello slot (le lezioni individuali sono pagate a parte e non scalano crediti)
        if (FLezioneIndividuale::prenota($id_slot, $id_utente)) {
            header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Lezione individuale prenotata con successo!"));
            exit;
        } else {
            $view->mostraErrore("Qualcuno ha appena prenotato questo orario. Seleziona un altro slot disponibile.");
        }
    }

    // Permette all'allievo di disdire una lezione individuale (senza variazioni sul saldo crediti)
    public function cancellaIndividuale() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['utente_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }

        $id_slot = (int)($_POST['id_slot'] ?? 0);
        $id_utente = (int)$_SESSION['utente_id'];

        if (FLezioneIndividuale::disdiciDaUtente($id_slot, $id_utente)) {
            header("Location: index.php?controller=utente&action=dashboard&msg=" . urlencode("Lezione individuale disdetta con successo."));
            exit;
        }

        header("Location: index.php?controller=utente&action=dashboard");
        exit;
    }
}
?>