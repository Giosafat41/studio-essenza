<?php
// File: View/VAdmin.php
require_once('StartSmarty.php');

class VAdmin extends StartSmarty {
    
    public function mostraDashboard($nome_admin) {
        $this->smarty->assign('titolo_pagina', 'Segreteria - Studio Essenza');
        $this->smarty->assign('nome_admin', $nome_admin);
        $this->smarty->display('admin_dashboard.tpl');
    }

    public function mostraFormLezione($corsi, $istruttori, $successo = null) {
        $this->smarty->assign('titolo_pagina', 'Nuova Lezione');
        $this->smarty->assign('corsi', $corsi);
        $this->smarty->assign('istruttori', $istruttori);
        if ($successo) $this->smarty->assign('messaggio_successo', $successo);
        $this->smarty->display('admin_lezione.tpl');
    }

    // Mostra l'elenco completo degli utenti iscritti
    public function mostraUtenti(array $utenti, $messaggio_successo = null) {
        $this->smarty->assign('titolo_pagina', 'Gestione Utenti - Studio Essenza');
        $this->smarty->assign('utenti', $utenti);
        if ($messaggio_successo) {
            $this->smarty->assign('messaggio_successo', $messaggio_successo);
        }
        $this->smarty->display('admin_utenti.tpl');
    }

    // Mostra il form di creazione ($utente = null) o modifica ($utente = EUtente)
    public function mostraFormUtente(?EUtente $utente = null, $errore = null) {
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
}
?>