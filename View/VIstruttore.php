<?php
// File: View/VIstruttore.php
require_once('StartSmarty.php');

class VIstruttore extends StartSmarty {

    public function mostraDashboard(
        EUtente $istruttore,
        array $corsi_futuri,
        array $corsi_passati,
        array $lezioni_individuali,
        int $conteggio_prenotate,
        int $conteggio_disponibili,
        $messaggio_successo = null,
        $messaggio_errore = null
    ) {
        $this->smarty->assign('titolo_pagina', 'Area Istruttore - Studio Essenza');
        $this->smarty->assign('nome_istruttore', $istruttore->getNome());
        $this->smarty->assign('cognome_istruttore', $istruttore->getCognome());
        $this->smarty->assign('email_istruttore', $istruttore->getEmail());
        $this->smarty->assign('telefono_istruttore', $istruttore->getTelefono());
        $this->smarty->assign('oggi_input', date('Y-m-d'));

        $this->smarty->assign('corsi_futuri', $corsi_futuri);
        $this->smarty->assign('corsi_passati', $corsi_passati);
        $this->smarty->assign('lezioni_individuali', $lezioni_individuali);
        $this->smarty->assign('conteggio_prenotate', $conteggio_prenotate);
        $this->smarty->assign('conteggio_disponibili', $conteggio_disponibili);

        if ($messaggio_successo) {
            $this->smarty->assign('messaggio_successo', $messaggio_successo);
        }
        if ($messaggio_errore) {
            $this->smarty->assign('messaggio_errore', $messaggio_errore);
        }

        $this->smarty->display('istruttore_dashboard.tpl');
    }

    public function mostraAppello(array $dettagli_lezione, array $iscritti) {
        $this->smarty->assign('titolo_pagina', 'Appello Corso - Studio Essenza');
        $this->smarty->assign('lezione', $dettagli_lezione);
        $this->smarty->assign('iscritti', $iscritti);

        $this->smarty->display('istruttore_appello.tpl');
    }
}
?>