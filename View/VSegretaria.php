<?php
// File: View/VSegretaria.php
require_once('StartSmarty.php');

class VSegretaria extends StartSmarty {

    public function mostraDashboard(
        $nome_segretaria,
        array $lezioni_disponibili = [],
        $totale_utenti = 0,
        $errore = null,
        $successo = null,
        bool $mostra_avviso_password = false
    ) {
        $this->smarty->assign('titolo_pagina', 'Pannello Segreteria - Studio Essenza');
        $this->smarty->assign('nome_segretaria', $nome_segretaria);
        $this->smarty->assign('lezioni_disponibili', $lezioni_disponibili);
        $this->smarty->assign('totale_utenti', $totale_utenti);
        $this->smarty->assign('mostra_avviso_password', $mostra_avviso_password);
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        $this->smarty->display('segretaria_dashboard.tpl');
    }

    public function mostraUtenti(array $utenti, $messaggio_successo = null, $messaggio_errore = null) {
        $this->smarty->assign('titolo_pagina', 'Gestione Utenti - Studio Essenza');
        $this->smarty->assign('controller_base', 'segretaria');
        $this->smarty->assign('label_dashboard', 'Pannello Segreteria');
        $this->smarty->assign('badge_sezione', 'Anagrafica Studio');
        $this->smarty->assign('titolo_sezione', 'Gestione Utenti');
        $this->smarty->assign('sottotitolo_sezione', 'Visualizza e aggiorna i dati completi, il saldo crediti e il certificato medico di allievi e istruttori.');
        $this->smarty->assign('label_nuovo', 'Nuovo Utente');
        $this->smarty->assign('mostra_colonne_allievo', true);
        $this->smarty->assign('utenti', $utenti);
        if ($messaggio_successo) {
            $this->smarty->assign('messaggio_successo', $messaggio_successo);
        }
        if ($messaggio_errore) {
            $this->smarty->assign('messaggio_errore', $messaggio_errore);
        }
        $this->smarty->display('admin_utenti.tpl');
    }

    public function mostraFormUtente(?EUtente $utente = null, $errore = null) {
        $this->smarty->assign('controller_base', 'segretaria');
        $this->smarty->assign('label_lista', 'Lista Utenti');
        $this->smarty->assign('badge_sezione', 'Anagrafica Studio');
        $this->smarty->assign('ruoli_consentiti', [
            'allievo' => 'Allievo',
            'istruttore' => 'Istruttore'
        ]);
        $this->smarty->assign('ruolo_default', 'allievo');

        if ($utente) {
            $this->smarty->assign('titolo_pagina', 'Modifica Utente - Studio Essenza');
            $this->smarty->assign('utente', $utente);
        } else {
            $this->smarty->assign('titolo_pagina', 'Nuovo Utente - Studio Essenza');
        }

        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_utente_form.tpl');
    }

    public function mostraAppello(
        array $dettagli_lezione,
        array $iscritti,
        array $istruttori = [],
        $successo = null,
        $errore = null
    ) {
        $this->smarty->assign('titolo_pagina', 'Gestione Lezione - Studio Essenza');
        $this->smarty->assign('controller_base', 'segretaria');
        $this->smarty->assign('label_dashboard', 'Pannello Segreteria');
        $this->smarty->assign('puo_eliminare_lezione', false);
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
}
?>
