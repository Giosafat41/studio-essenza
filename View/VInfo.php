
<?php
// File: View/VInfo.php
require_once('StartSmarty.php');

class VInfo extends StartSmarty {
    
    // Mostra la pagina "Il Metodo"
    public function mostraMetodo() {
        $this->smarty->assign('titolo_pagina', 'Il nostro Metodo - Studio Essenza');
        $this->smarty->display('metodo.tpl');
    }

    // Mostra la pagina "Tariffe"
    public function mostraTariffe(array $istruttori_tariffe = []) {
        $this->smarty->assign('titolo_pagina', 'Tariffe e Pacchetti - Studio Essenza');
        $this->smarty->assign('istruttori_tariffe', $istruttori_tariffe);
        $this->smarty->display('tariffe.tpl');
    }

    // Mostra la pagina "Contatti" ed eventuale messaggio di conferma invio
    public function mostraContatti($messaggio_conferma = null) {
        $this->smarty->assign('titolo_pagina', 'Contatti - Studio Essenza');
        
        if ($messaggio_conferma) {
            $this->smarty->assign('conferma', $messaggio_conferma);
        }
        
        $this->smarty->display('contatti.tpl');
    }
}
?>