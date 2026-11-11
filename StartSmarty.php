<?php
require_once('Smarty/Smarty.class.php'); 

class StartSmarty {
    protected $smarty;

    public function __construct() {
        $this->smarty = new Smarty();

        // Configurazione dei percorsi obbligatori per il funzionamento di Smarty
        $this->smarty->setTemplateDir('Smarty/templates/');
        $this->smarty->setCompileDir('Smarty/templates_c/');
        $this->smarty->setCacheDir('Smarty/cache/');
        $this->smarty->setConfigDir('Smarty/configs/');
    }
}
?>
VUtente.php
<?php
// File: View/VUtente.php
require_once('StartSmarty.php');

class VUtente extends StartSmarty {

    // Mostra la homepage pubblica
    public function mostraHome() {
        // Assegna delle variabili che verranno lette dall'HTML
        $this->smarty->assign('titolo_pagina', 'Home - Studio Essenza');
        $this->smarty->assign('messaggio_benvenuto', 'Scopri il vero equilibrio con il Metodo Essenza.');

        // Renderizza il file template HTML
        $this->smarty->display('home.tpl');
    }

    // Mostra la dashboard privata dell'allievo
    public function mostraDashboardAllievo(EUtente $utente) {
        // Passiamo i dati dell'Entity al template
        $this->smarty->assign('nome_utente', $utente->getNome());
        $this->smarty->assign('crediti', $utente->getCreditiResidui());

        // Passiamo un booleano per attivare un avviso visivo se i crediti sono bassi
        $crediti_bassi = ($utente->getCreditiResidui() <= 1) ? true : false;
        $this->smarty->assign('avviso_crediti', $crediti_bassi);

        $this->smarty->display('dashboard_allievo.tpl');
    }
}
?>