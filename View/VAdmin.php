<?php
// File: View/VAdmin.php
require_once('StartSmarty.php');

class VAdmin extends StartSmarty {

    public function mostraDashboard(
        $nome_admin,
        array $lezioni_disponibili = [],
        $totale_staff = 0,
        $totale_corsi = 0,
        $errore = null,
        $successo = null,
        $totale_allievi = 0
    ) {
        $this->smarty->assign('titolo_pagina', 'Pannello Admin - Studio Essenza');
        $this->smarty->assign('nome_admin', $nome_admin);
        $this->smarty->assign('lezioni_disponibili', $lezioni_disponibili);
        $this->smarty->assign('totale_staff', $totale_staff);
        $this->smarty->assign('totale_allievi', $totale_allievi);
        $this->smarty->assign('totale_corsi', $totale_corsi);
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        $this->smarty->display('admin_dashboard.tpl');
    }

    // Mostra l'elenco completo di tutti gli allievi iscritti con dettagli completi
    public function mostraAllievi(array $allievi, string $allievi_json = '{}') {
        $this->smarty->assign('titolo_pagina', 'Elenco Allievi - Studio Essenza');
        $this->smarty->assign('allievi', $allievi);
        $this->smarty->assign('allievi_json', $allievi_json);
        $this->smarty->display('admin_allievi.tpl');
    }

    public function mostraCorsi(array $corsi, ?ECorso $corso_in_modifica = null, $successo = null, $errore = null) {
        $this->smarty->assign('titolo_pagina', 'Gestione Corsi - Studio Essenza');
        $this->smarty->assign('corsi', $corsi);
        if ($corso_in_modifica) {
            $this->smarty->assign('corso_in_modifica', $corso_in_modifica);
        }
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_corsi.tpl');
    }

    public function mostraFormLezione($corsi, $istruttori, $successo = null, $errore = null) {
        $this->smarty->assign('titolo_pagina', 'Nuova Lezione - Studio Essenza');
        $this->smarty->assign('corsi', $corsi);
        $this->smarty->assign('istruttori', $istruttori);
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_lezione.tpl');
    }

    public function mostraAppello(
        array $dettagli_lezione,
        array $iscritti,
        array $istruttori = [],
        $successo = null,
        $errore = null
    ) {
        $this->smarty->assign('titolo_pagina', 'Gestione Lezione - Studio Essenza');
        $this->smarty->assign('controller_base', 'admin');
        $this->smarty->assign('label_dashboard', 'Pannello Admin');
        $this->smarty->assign('puo_eliminare_lezione', true);
        $this->smarty->assign('lezione', $dettagli_lezione);
        $this->smarty->assign('iscritti', $iscritti);
        $this->smarty->assign('istruttori', $istruttori);
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_appello.tpl');
    }

    // Mostra l'elenco dei segretari e degli istruttori
    public function mostraUtenti(array $utenti, $messaggio_successo = null, $messaggio_errore = null) {
        $this->smarty->assign('titolo_pagina', 'Gestione Staff - Studio Essenza');
        $this->smarty->assign('controller_base', 'admin');
        $this->smarty->assign('label_dashboard', 'Pannello Admin');
        $this->smarty->assign('badge_sezione', 'Staff Studio');
        $this->smarty->assign('titolo_sezione', 'Gestione Segretari e Istruttori');
        $this->smarty->assign('sottotitolo_sezione', 'Crea e gestisci i profili dei segretari e degli istruttori di Studio Essenza.');
        $this->smarty->assign('label_nuovo', 'Nuovo Profilo Staff');
        $this->smarty->assign('mostra_colonne_allievo', false);
        $this->smarty->assign('utenti', $utenti);
        if ($messaggio_successo) {
            $this->smarty->assign('messaggio_successo', $messaggio_successo);
        }
        if ($messaggio_errore) {
            $this->smarty->assign('messaggio_errore', $messaggio_errore);
        }
        $this->smarty->display('admin_utenti.tpl');
    }

    // Mostra il form di creazione/modifica profilo staff (segretaria / istruttore)
    public function mostraFormUtente(?EUtente $utente = null, $errore = null) {
        $this->smarty->assign('controller_base', 'admin');
        $this->smarty->assign('label_lista', 'Lista Staff');
        $this->smarty->assign('badge_sezione', 'Staff Studio');
        $this->smarty->assign('ruoli_consentiti', [
            'segretaria' => 'Segretaria',
            'istruttore' => 'Istruttore'
        ]);
        $this->smarty->assign('ruolo_default', 'segretaria');
        $this->smarty->assign('oggi_input', date('Y-m-d'));

        if ($utente) {
            $this->smarty->assign('titolo_pagina', 'Modifica Profilo Staff - Studio Essenza');
            $this->smarty->assign('utente', $utente);
        } else {
            $this->smarty->assign('titolo_pagina', 'Nuovo Profilo Staff - Studio Essenza');
        }

        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_utente_form.tpl');
    }
}
?>
