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

            $dati_corso = [
                'id_lezione' => $lezione->getId(),
                'nome_corso' => $corso ? $corso->getNome() : 'Corso',
                'capienza_max' => $corso ? $corso->getCapienzaMax() : 0,
                'num_iscritti' => count($prenotazioni),
                'data_formattata' => date('d/m/Y', strtotime($lezione->getDataOraInizio())),
                'ora_inizio' => date('H:i', strtotime($lezione->getDataOraInizio())),
                'ora_fine' => date('H:i', strtotime($lezione->getDataOraFine()))
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

        $view = new VIstruttore();
        $view->mostraDashboard(
            $istruttore,
            $corsi_futuri,
            $corsi_passati,
            $lezioni_individuali,
            $conteggio_prenotate,
            $conteggio_disponibili,
            $msg,
            $err
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
        $saltati_sovrapposizione = 0;
        $saltati_passati = 0;

        for ($ora = $ora_inizio; $ora < $ora_fine; $ora++) {
            $inizio_slot = sprintf('%s %02d:00:00', $data, $ora);
            $fine_slot = sprintf('%s %02d:00:00', $data, $ora + 1);

            if (strtotime($inizio_slot) <= time()) {
                $saltati_passati++;
                continue;
            }

            if (FLezioneIndividuale::hasSovrapposizione($id_istruttore, $inizio_slot, $fine_slot)) {
                $saltati_sovrapposizione++;
                continue;
            }

            $nuovoSlot = new ELezioneIndividuale($id_istruttore, $inizio_slot, $fine_slot);
            if (FLezioneIndividuale::store($nuovoSlot)) {
                $inseriti++;
            }
        }

        if ($inseriti > 0) {
            $messaggio = "Inseriti {$inseriti} slot di disponibilità da 1 ora.";
            if ($saltati_sovrapposizione > 0) {
                $messaggio .= " ({$saltati_sovrapposizione} saltati perché già occupati da altri impegni o corsi).";
            }
            header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode($messaggio));
        } else {
            $errore = "Nessuno slot inserito.";
            if ($saltati_sovrapposizione > 0) {
                $errore = "Tutti gli orari selezionati si sovrappongono a corsi o disponibilità già esistenti.";
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

    // Annulla una lezione individuale già prenotata con motivazione e rimborso credito
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

            if ($annullata && $slot->getIdUtente()) {
                // Rimborso automatico di 1 credito all'allievo
                $allievo = FUtente::load($slot->getIdUtente());
                if ($allievo) {
                    $allievo->ricaricaCrediti(1);
                    FUtente::update($allievo);
                }

                header("Location: index.php?controller=istruttore&action=dashboard&msg=" . urlencode("Lezione individuale annullata. La motivazione è visibile all'allievo e il credito è stato rimborsato."));
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
}
?>