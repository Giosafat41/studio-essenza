<?php
// File: View/VPrenotazione.php
require_once('StartSmarty.php');

class VPrenotazione extends StartSmarty {
    
    public function mostraCalendario($calendario, $crediti_residui) {
        $this->smarty->assign('titolo_pagina', 'Calendario Lezioni - Studio Essenza');
        $this->smarty->assign('calendario', $calendario);
        $this->smarty->assign('crediti', $crediti_residui);
        
        $this->smarty->display('calendario.tpl');
    }

    public function mostraErrore($messaggio) {
        $this->smarty->assign('titolo_pagina', 'Errore Prenotazione');
        $this->smarty->assign('errore', $messaggio);
        $this->smarty->display('errore.tpl');
    }
}
?>