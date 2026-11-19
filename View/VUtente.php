<?php
// File: View/VUtente.php
require_once('StartSmarty.php');

class VUtente extends StartSmarty {
    
    // Mostra la homepage pubblica
    public function mostraHome(array $istruttori = []) {
        $this->smarty->assign('titolo_pagina', 'Home - Studio Essenza');
        $this->smarty->assign('messaggio_benvenuto', 'Scopri il vero equilibrio con il Metodo Essenza.');
        $this->smarty->assign('istruttori', $istruttori);

        $this->smarty->display('home.tpl');
    }

    // Mostra il form di login
    public function mostraLogin($errore = null) {
        $this->smarty->assign('titolo_pagina', 'Accedi - Studio Essenza');
        
        if ($errore) {
            $this->smarty->assign('errore', $errore);
        }
        
        $this->smarty->display('login.tpl');
    }

    // Mostra il form di registrazione
    public function mostraRegistrazione($errore = null) {
        $this->smarty->assign('titolo_pagina', 'Registrati - Studio Essenza');
        
        if ($errore) {
            $this->smarty->assign('errore', $errore);
        }
        
        $this->smarty->display('registrazione.tpl');
    }

    // Mostra la dashboard privata dell'allievo
    public function mostraDashboardAllievo(
        EUtente $utente,
        array $mie_prenotazioni = [],
        array $lezioni_individuali = [],
        $messaggio_successo = null,
        $messaggio_errore = null
    ) {
        $this->smarty->assign('titolo_pagina', 'La mia Dashboard - Studio Essenza');
        $this->smarty->assign('nome_utente', $utente->getNome());
        $this->smarty->assign('crediti', $utente->getCreditiResidui());
        $this->smarty->assign('mie_prenotazioni', $mie_prenotazioni);
        $this->smarty->assign('lezioni_individuali', $lezioni_individuali);

        // Passiamo un booleano per attivare un avviso visivo se i crediti sono bassi
        $crediti_bassi = ($utente->getCreditiResidui() <= 1);
        $this->smarty->assign('avviso_crediti', $crediti_bassi);

        if ($messaggio_successo) {
            $this->smarty->assign('messaggio_successo', $messaggio_successo);
        }
        if ($messaggio_errore) {
            $this->smarty->assign('messaggio_errore', $messaggio_errore);
        }

        $this->smarty->display('dashboard_allievo.tpl');
    }
}
?>