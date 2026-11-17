<?php
// File: StartSmarty.php
require_once('Smarty/Smarty.class.php'); 

class StartSmarty {
    public $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir('Smarty/templates/');
        $this->smarty->setCompileDir('Smarty/templates_c/');
        $this->smarty->setCacheDir('Smarty/cache/');
        $this->smarty->setConfigDir('Smarty/configs/');

        // Passa automaticamente lo stato della sessione alla barra di navigazione di layout.tpl
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['utente_id'])) {
            $this->smarty->assign('utente_loggato', true);
            $this->smarty->assign('ruolo_loggato', $_SESSION['ruolo']);
        }
    }
}
?>