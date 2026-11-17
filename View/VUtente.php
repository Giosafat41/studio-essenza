<?php
// File: View/VUtente.php
require_once('StartSmarty.php');

class VUtente extends StartSmarty {
    
    public function mostraHome() {
        $this->smarty->assign('titolo_pagina', 'Home - Studio Essenza');
        $this->smarty->assign('messaggio_benvenuto', 'Scopri il vero equilibrio con il Metodo Essenza.');
        $this->smarty->display('home.tpl');
    }

    public function mostraLogin($errore = null) {
        $this->smarty->assign('titolo_pagina', 'Accedi - Studio Essenza');
        if ($errore) {
            $this->smarty->assign('errore', $errore);
        }
        $this->smarty->display('login.tpl');
    }

    public function mostraRegistrazione($errore = null) {
        $this->smarty->assign('titolo_pagina', 'Registrati - Studio Essenza');
        if ($errore) {
            $this->smarty->assign('errore', $errore);
        }
        $this->smarty->display('registrazione.tpl');
    }

    // Mostra la dashboard privata dell'allievo completa di profilo e prenotazioni
    public function mostraDashboardAllievo(EUtente $utente, array $prenotazioni = []) {
        $this->smarty->assign('titolo_pagina', 'La mia Dashboard - Studio Essenza');
        
        // Dati profilo allievo
        $this->smarty->assign('nome_utente', $utente->getNome());
        $this->smarty->assign('cognome_utente', $utente->getCognome());
        $this->smarty->assign('email_utente', $utente->getEmail());
        $this->smarty->assign('telefono_utente', $utente->getTelefono());
        $this->smarty->assign('scadenza_certificato', $utente->getScadenzaCertificato());
        
        // Gestione crediti
        $crediti = $utente->getCreditiResidui();
        $this->smarty->assign('crediti', $crediti);
        $this->smarty->assign('avviso_crediti', ($crediti <= 1));

        // Lista prenotazioni attive
        $this->smarty->assign('mie_prenotazioni', $prenotazioni);

        $this->smarty->display('dashboard_allievo.tpl');
    }
}
?>