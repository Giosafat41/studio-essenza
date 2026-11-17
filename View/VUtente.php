<?php
// File: View/VUtente.php
require_once('StartSmarty.php');

class VUtente extends StartSmarty {
    
    // Mostra la homepage pubblica
    public function mostraHome() {
        $this->smarty->assign('titolo_pagina', 'Home - Studio Essenza');
        $this->smarty->assign('messaggio_benvenuto', 'Scopri il vero equilibrio con il Metodo Essenza.');
        
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
    public function mostraDashboardAllievo(EUtente $utente) {
        $this->smarty->assign('titolo_pagina', 'La mia Dashboard - Studio Essenza');
        $this->smarty->assign('nome_utente', $utente->getNome());
        $this->smarty->assign('crediti', $utente->getCreditiResidui());
        
        // Passiamo un booleano per attivare un avviso visivo se i crediti sono bassi
        $crediti_bassi = ($utente->getCreditiResidui() <= 1) ? true : false;
        $this->smarty->assign('avviso_crediti', $crediti_bassi);

        $this->smarty->display('dashboard_allievo.tpl');
    }
}
?>