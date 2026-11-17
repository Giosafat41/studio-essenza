<?php
// File: View/VAdmin.php
require_once('StartSmarty.php');

class VAdmin extends StartSmarty {
    
    public function mostraDashboard($nome_admin) {
        $this->smarty->assign('titolo_pagina', 'Segreteria - Studio Essenza');
        $this->smarty->assign('nome_admin', $nome_admin);
        $this->smarty->display('admin_dashboard.tpl');
    }

    public function mostraFormRicarica($successo = null, $errore = null) {
        $this->smarty->assign('titolo_pagina', 'Ricarica Crediti');
        if ($successo) $this->smarty->assign('messaggio_successo', $successo);
        if ($errore) $this->smarty->assign('messaggio_errore', $errore);
        $this->smarty->display('admin_ricarica.tpl');
    }

    public function mostraFormLezione($corsi, $istruttori, $successo = null) {
        $this->smarty->assign('titolo_pagina', 'Nuova Lezione');
        $this->smarty->assign('corsi', $corsi);
        $this->smarty->assign('istruttori', $istruttori);
        if ($successo) $this->smarty->assign('messaggio_successo', $successo);
        $this->smarty->display('admin_lezione.tpl');
    }
    public function mostraFormCertificato($successo = null, $errore = null) {
        $this->smarty->assign('titolo_pagina', 'Gestione Certificato Medico - Studio Essenza');
        if ($successo) {
            $this->smarty->assign('messaggio_successo', $successo);
        }
        if ($errore) {
            $this->smarty->assign('messaggio_errore', $errore);
        }
        $this->smarty->display('admin_certificato.tpl');
    }
}
?>