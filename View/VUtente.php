<?php
// File: View/VUtente.php
require_once('StartSmarty.php');

class VUtente extends StartSmarty {
    
    // Mostra il form di login
    public function mostraLogin($errore = null) {
        $this->smarty->assign('titolo_pagina', 'Accedi - Studio Essenza');
        
        // Se c'è un errore (es. password errata), lo passiamo al template
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
}
?>