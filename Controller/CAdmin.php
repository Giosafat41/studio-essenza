<?php
// File: Controller/CAdmin.php

class CAdmin {

    // Ruoli gestiti dall'unico Admin: segretari e istruttori (mai altri admin né allievi)
    private const RUOLI_GESTITI = ['segretaria', 'istruttore'];

    private function verificaAdmin() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['utente_id']) || ($_SESSION['ruolo'] ?? '') !== 'admin') {
            header("Location: index.php?controller=utente&action=login");
            exit;
        }
        $admin = FUtente::load((int)$_SESSION['utente_id']);
        if (!$admin || $admin->getRuolo() !== 'admin') {
            header("Location: index.php?controller=utente&action=logout");
            exit;
        }
        return $admin;
    }

    // Normalizza nome e cognome nel formato "nome.cognome" per la password iniziale
    public static function generaPasswordIniziale(string $nome, string $cognome): string {
        $pulisci = function (string $testo): string {
            $testo = trim($testo);
            if ($testo === '') {
                return '';
            }
            $mappa = [
                'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a',
                'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e',
                'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i',
                'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o',
                'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u',
                'ç' => 'c', 'Ç' => 'c', 'ñ' => 'n', 'Ñ' => 'n'
            ];
            $testo = strtr($testo, $mappa);
            $testo = strtolower($testo);
            return preg_replace('/[^a-z0-9]/', '', $testo) ?? '';
        };

        $parteNome = $pulisci($nome);
        $parteCognome = $pulisci($cognome);

        if ($parteNome !== '' && $parteCognome !== '') {
            return $parteNome . '.' . $parteCognome;
        }
        return $parteNome . $parteCognome;
    }

    public function dashboard() {
        $admin = $this->verificaAdmin();

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

        $totale_staff = count(FUtente::loadByRuoli(self::RUOLI_GESTITI));
        $totale_corsi = count(FCorso::loadAll());
        $messaggio_errore = $_GET['err'] ?? null;
        $messaggio_successo = $_GET['msg'] ?? null;

        $view = new VAdmin();
        $view->mostraDashboard(
            $admin->getNome(),
            $lezioni_disponibili,
            $totale_staff,
            $totale_corsi,
            $messaggio_errore,
            $messaggio_successo
        );
    }

    // =========================================================================
    // GESTIONE CORSI (solo Admin)
    // =========================================================================

    public function corsi() {
        $this->verificaAdmin();

        $corsi_entity = FCorso::loadAll();
        $corsi_lista = [];
        foreach ($corsi_entity as $c) {
            $corsi_lista[] = [
                'id' => $c->getId(),
                'nome' => $c->getNome(),
                'descrizione' => $c->getDescrizione(),
                'capienza_max' => (int)$c->getCapienzaMax(),
                'num_lezioni' => FCorso::countLezioni((int)$c->getId())
            ];
        }

        $corso_in_modifica = null;
        if (isset($_GET['edit'])) {
            $id_edit = (int)$_GET['edit'];
            if ($id_edit > 0) {
                $corso_in_modifica = FCorso::load($id_edit);
            }
        }

        $view = new VAdmin();
        $view->mostraCorsi(
            $corsi_lista,
            $corso_in_modifica,
            $_GET['msg'] ?? null,
            $_GET['err'] ?? null
        );
    }

    public function salvaCorso() {
        $this->verificaAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=admin&action=corsi");
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $descrizione = trim($_POST['descrizione'] ?? '');
        $capienza_max = (int)($_POST['capienza_max'] ?? 0);

        if ($nome === '' || $capienza_max < 1 || $capienza_max > 100) {
            header("Location: index.php?controller=admin&action=corsi&err=" . urlencode("Inserisci un nome valido e una capienza compresa tra 1 e 100 posti."));
            exit;
        }

        if ($id > 0) {
            $corso = FCorso::load($id);
            if (!$corso) {
                header("Location: index.php?controller=admin&action=corsi&err=" . urlencode("Corso non trovato."));
                exit;
            }
            $corso->setNome($nome);
            $corso->setDescrizione($descrizione !== '' ? $descrizione : null);
            $corso->setCapienzaMax($capienza_max);
            FCorso::update($corso);
            header("Location: index.php?controller=admin&action=corsi&msg=" . urlencode("Corso \"{$nome}\" aggiornato con successo."));
        } else {
            $nuovoCorso = new ECorso($nome, $descrizione !== '' ? $descrizione : null, $capienza_max);
            FCorso::store($nuovoCorso);
            header("Location: index.php?controller=admin&action=corsi&msg=" . urlencode("Nuovo corso \"{$nome}\" inserito con successo."));
        }
        exit;
    }

    public function eliminaCorso() {
        $this->verificaAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=admin&action=corsi");
            exit;
        }

        $id = (int)($_POST['id_corso'] ?? 0);
        $corso = FCorso::load($id);
        if (!$corso) {
            header("Location: index.php?controller=admin&action=corsi&err=" . urlencode("Corso non trovato."));
            exit;
        }

        $num_lezioni = FCorso::countLezioni($id);
        if ($num_lezioni > 0) {
            header("Location: index.php?controller=admin&action=corsi&err=" . urlencode("Impossibile eliminare il corso \"{$corso->getNome()}\": risultano {$num_lezioni} lezioni associate."));
            exit;
        }

        FCorso::delete($id);
        header("Location: index.php?controller=admin&action=corsi&msg=" . urlencode("Corso \"{$corso->getNome()}\" eliminato."));
        exit;
    }

    // =========================================================================
    // GESTIONE PALINSESTO E LEZIONI (solo Admin crea/elimina; Admin gestisce)
    // =========================================================================

    public function aggiungiLezione() {
        $this->verificaAdmin();

        $view = new VAdmin();
        $corsi = FCorso::loadAll();
        $istruttori = FUtente::loadSoloIstruttori();

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

            $istruttoreObj = FUtente::load($id_istruttore);
            if (!$istruttoreObj || $istruttoreObj->getRuolo() !== 'istruttore') {
                $view->mostraFormLezione($corsi, $istruttori, null, "Seleziona un istruttore valido.");
                return;
            }

            $data_inizio = date('Y-m-d H:i:s', $ts_inizio);
            $data_fine = date('Y-m-d H:i:s', $ts_inizio + ($durata_minuti * 60));

            if (FLezione::hasSovrapposizione($id_istruttore, $data_inizio, $data_fine)) {
                $view->mostraFormLezione(
                    $corsi,
                    $istruttori,
                    null,
                    "Impossibile salvare: l'istruttore selezionato è già assegnato a un'altra lezione di gruppo in questa fascia oraria."
                );
                return;
            }

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

            $lezione = new ELezione($id_corso, $id_istruttore, $data_inizio, $data_fine, $durata_minuti);
            FLezione::store($lezione);

            $slot_rimossi = FLezioneIndividuale::rimuoviDisponibiliSovrapposte($id_istruttore, $data_inizio, $data_fine);

            $messaggio = "Lezione inserita con successo nel palinsesto (" . date('d/m/Y H:i', $ts_inizio) . " - " . date('H:i', $ts_inizio + ($durata_minuti * 60)) . ").";
            if ($slot_rimossi > 0) {
                $label_slot = ($slot_rimossi === 1) ? "1 slot di disponibilità individuale sovrapposto" : "{$slot_rimossi} slot di disponibilità individuale sovrapposti";
                $messaggio .= " Rimosso automaticamente {$label_slot} dall'agenda dell'istruttore.";
            }

            $view->mostraFormLezione($corsi, $istruttori, $messaggio);
        } else {
            $view->mostraFormLezione($corsi, $istruttori);
        }
    }

    // Gestione singola lezione: iscritti, disiscrizione, cambio istruttore, eliminazione
    public function appello() {
        $this->verificaAdmin();

        $id_lezione = isset($_GET['id_lezione']) ? (int)$_GET['id_lezione'] : 0;
        if ($id_lezione <= 0) {
            header("Location: index.php?controller=admin&action=dashboard&err=" . urlencode("Seleziona una lezione valida da gestire."));
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

        $view = new VAdmin();
        $view->mostraAppello(
            $dettagli_lezione,
            $iscritti,
            $istruttori,
            $_GET['msg'] ?? null,
            $_GET['err'] ?? null
        );
    }

    public function disiscriviAllievo() {
        $this->verificaAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=admin&action=dashboard");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $id_prenotazione = (int)($_POST['id_prenotazione'] ?? 0);
        $prenotazione = FPrenotazione::load($id_prenotazione);

        if (!$prenotazione || (int)$prenotazione->getIdLezione() !== $id_lezione) {
            header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Prenotazione non trovata."));
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

        header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("{$nome_allievo} è stato disiscritto dalla lezione (1 credito riaccreditato)."));
        exit;
    }

    public function cambiaIstruttoreLezione() {
        $this->verificaAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=admin&action=dashboard");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $nuovo_id_istruttore = (int)($_POST['id_istruttore'] ?? 0);
        $lezione = FLezione::load($id_lezione);

        if (!$lezione) {
            header("Location: index.php?controller=admin&action=dashboard&err=" . urlencode("Lezione non trovata."));
            exit;
        }

        $nuovoIstruttore = FUtente::load($nuovo_id_istruttore);
        if (!$nuovoIstruttore || $nuovoIstruttore->getRuolo() !== 'istruttore') {
            header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Seleziona un istruttore valido."));
            exit;
        }

        if ((int)$lezione->getIdIstruttore() === $nuovo_id_istruttore) {
            header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("L'istruttore selezionato è già assegnato a questa lezione."));
            exit;
        }

        if (FLezione::hasSovrapposizione($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine(), $id_lezione)) {
            header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Impossibile cambiare istruttore: {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()} è già assegnato a un'altra lezione di gruppo in questa fascia oraria."));
            exit;
        }

        $prenotate_conflitto = FLezioneIndividuale::findPrenotateSovrapposte($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine());
        if (!empty($prenotate_conflitto)) {
            header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&err=" . urlencode("Impossibile cambiare istruttore: {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()} ha già una lezione individuale prenotata in questa fascia oraria."));
            exit;
        }

        FLezione::updateIstruttore($id_lezione, $nuovo_id_istruttore);
        FLezioneIndividuale::rimuoviDisponibiliSovrapposte($nuovo_id_istruttore, $lezione->getDataOraInizio(), $lezione->getDataOraFine());

        header("Location: index.php?controller=admin&action=appello&id_lezione={$id_lezione}&msg=" . urlencode("Istruttore aggiornato a {$nuovoIstruttore->getNome()} {$nuovoIstruttore->getCognome()}."));
        exit;
    }

    public function eliminaLezione() {
        $this->verificaAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?controller=admin&action=dashboard");
            exit;
        }

        $id_lezione = (int)($_POST['id_lezione'] ?? 0);
        $lezione = FLezione::load($id_lezione);
        if (!$lezione) {
            header("Location: index.php?controller=admin&action=dashboard&err=" . urlencode("Lezione non trovata."));
            exit;
        }

        // Rimborsa 1 credito agli allievi eventualmente prenotati prima di eliminare la lezione
        $prenotazioni = FPrenotazione::loadByLezione($id_lezione);
        foreach ($prenotazioni as $p) {
            $allievo = FUtente::load($p->getIdUtente());
            if ($allievo) {
                $allievo->ricaricaCrediti(1);
                FUtente::update($allievo);
            }
        }

        FLezione::delete($id_lezione);
        $msg = "Lezione eliminata dal calendario.";
        if (count($prenotazioni) > 0) {
            $msg .= " Riaccreditato 1 ingresso ai " . count($prenotazioni) . " allievi prenotati.";
        }
        header("Location: index.php?controller=admin&action=dashboard&msg=" . urlencode($msg));
        exit;
    }

    // =========================================================================
    // GESTIONE STAFF (solo Segretari e Istruttori)
    // =========================================================================

    public function utenti() {
        $this->verificaAdmin();

        $utenti = FUtente::loadByRuoli(self::RUOLI_GESTITI);
        $messaggio = $_GET['msg'] ?? null;
        $errore = $_GET['err'] ?? null;

        $view = new VAdmin();
        $view->mostraUtenti($utenti, $messaggio, $errore);
    }

    public function modificaUtente() {
        $this->verificaAdmin();
        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $utente = FUtente::load($id);

            if (!$utente || !in_array($utente->getRuolo(), self::RUOLI_GESTITI, true)) {
                header("Location: index.php?controller=admin&action=utenti&err=" . urlencode("Non puoi modificare questo profilo da questa sezione."));
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
                $view->mostraFormUtente($utente, "Ruolo non consentito. Puoi assegnare solo i ruoli Segretaria o Istruttore.");
                return;
            }

            $utente->setNome(trim($_POST['nome'] ?? ''));
            $utente->setCognome(trim($_POST['cognome'] ?? ''));
            $utente->setEmail($nuova_email);
            $utente->setTelefono(trim($_POST['telefono'] ?? ''));
            $utente->setRuolo($ruolo);
            $utente->setCreditiResidui(0);
            $utente->setScadenzaCertificato(null);

            if ($ruolo === 'istruttore') {
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
                // segretaria
                $utente->setDescrizione(null);
                $utente->setTariffaIndividuale(null);
                if ($utente->getImmagineProfilo()) {
                    UImmagine::eliminaImmagineProfilo($utente->getImmagineProfilo());
                    $utente->setImmagineProfilo(null);
                }
            }

            FUtente::update($utente);

            header("Location: index.php?controller=admin&action=utenti&msg=" . urlencode("Profilo di {$utente->getNome()} {$utente->getCognome()} aggiornato con successo."));
            exit;
        } else {
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            $utente = FUtente::load($id);
            if (!$utente || !in_array($utente->getRuolo(), self::RUOLI_GESTITI, true)) {
                header("Location: index.php?controller=admin&action=utenti&err=" . urlencode("Profilo non trovato o non modificabile."));
                exit;
            }
            $view->mostraFormUtente($utente);
        }
    }

    public function creaUtente() {
        $this->verificaAdmin();
        $view = new VAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $cognome = trim($_POST['cognome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            if ($password === '') {
                $password = self::generaPasswordIniziale($nome, $cognome);
            }
            if ($password === '') {
                $view->mostraFormUtente(null, "Imposta una password iniziale valida per il nuovo profilo.");
                return;
            }
            $telefono = trim($_POST['telefono'] ?? '');
            $ruolo = $_POST['ruolo'] ?? '';

            if (!in_array($ruolo, self::RUOLI_GESTITI, true)) {
                $view->mostraFormUtente(null, "Ruolo non consentito. Da questo pannello puoi creare solo Segretari o Istruttori.");
                return;
            }

            $tariffa_individuale = null;
            $descrizione = null;

            if ($ruolo === 'istruttore') {
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

            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono, $ruolo, 0, null, $descrizione, null, $tariffa_individuale, true);
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

                header("Location: index.php?controller=admin&action=utenti&msg=" . urlencode("Nuovo profilo ({$nome} {$cognome} - {$ruolo}) creato con successo. Password iniziale: {$password}"));
                exit;
            } else {
                $view->mostraFormUtente(null, "Errore durante la creazione del profilo.");
            }
        } else {
            $view->mostraFormUtente(null);
        }
    }
}
?>
