
<?php

// Caricamento della libreria Smarty 5
require_once __DIR__ . '/Smarty/Smarty.class.php';

class StartSmarty {

    protected $smarty;

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

    }

    // Restituisce l'istanza Smarty
    public function getSmarty() {
        return $this->smarty;
    }

}
