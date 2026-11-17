<?php
// File: StartSmarty.php

// Caricamento della libreria Smarty 5
require_once __DIR__ . '/Smarty/Smarty.class.php';

class StartSmarty {

    public $smarty;

    public function __construct() {

        // Inizializzazione di Smarty 5
        $this->smarty = new Smarty\Smarty();

        // Percorso principale del progetto
        $baseDir = __DIR__;

        // Configurazione delle directory
        $this->smarty->setTemplateDir($baseDir . '/Smarty/templates/');
        $this->smarty->setCompileDir($baseDir . '/Smarty/templates_c/');
        $this->smarty->setCacheDir($baseDir . '/Smarty/cache/');
        $this->smarty->setConfigDir($baseDir . '/Smarty/configs/');

        // Passa automaticamente lo stato della sessione alla barra di navigazione di layout.tpl
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['utente_id'])) {
            $this->smarty->assign('utente_loggato', true);
            $this->smarty->assign('ruolo_loggato', $_SESSION['ruolo']);
        }
    }

    // Restituisce l'istanza Smarty
    public function getSmarty() {
        return $this->smarty;
    }
}
?>