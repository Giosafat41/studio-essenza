<?php
// File: View/VPrenotazione.php
require_once('StartSmarty.php');

class VPrenotazione extends StartSmarty {

    public function mostraCalendario(
        array $lezioni_corsi,
        array $istruttori = [],
        string $slot_individuali_json = '{}',
        int $crediti_residui = 0,
        bool $certificato_valido = false
    ) {
        $this->smarty->assign('titolo_pagina', 'Prenota Lezione - Studio Essenza');
        $this->smarty->assign('lezioni', $lezioni_corsi);
        $this->smarty->assign('istruttori', $istruttori);
        $this->smarty->assign('slot_individuali_json', $slot_individuali_json);
        $this->smarty->assign('crediti_residui', $crediti_residui);
        $this->smarty->assign('certificato_valido', $certificato_valido);
        $this->smarty->display('calendario.tpl');
    }

    public function mostraErrore($messaggio) {
        $this->smarty->assign('titolo_pagina', 'Avviso Prenotazione - Studio Essenza');
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->assign('messaggio_errore', $messaggio);
        $this->smarty->display('errore.tpl');
    }
}
?>