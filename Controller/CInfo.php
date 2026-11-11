<?php
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
