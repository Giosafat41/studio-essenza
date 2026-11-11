<?php
require_once('StartSmarty.php');

class VInfo extends StartSmarty {

    // Metodo per mostrare la pagina delle tariffe
    public function mostraTariffe() {
        // Assegniamo il titolo dinamico per il tag <title> nel layout.tpl
        $this->smarty->assign('titolo_pagina', 'Tariffe e Pacchetti - Studio Essenza');

        // Diciamo a Smarty di stampare a schermo il template
        $this->smarty->display('tariffe.tpl');
    }

    // Qui in futuro potrai aggiungere metodi simili come mostraMetodo() o mostraContatti()
}
?>
<?php
// File: Controller/CInfo.php

class CInfo {

    // ... (metodo metodo() e contatti() rimangono invariati per ora)

    // Nuova versione del metodo tariffe
    public function tariffe() {
        // 1. Istanzia la classe View dedicata alle informazioni
        $view = new VInfo();

        // 2. Richiama il metodo che stampa il template Smarty
        $view->mostraTariffe();
    }

    // ...
}
?>