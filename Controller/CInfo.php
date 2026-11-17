
<?php
// File: Controller/CInfo.php

class CInfo {
    
    // Mostra la pagina "Il nostro Metodo"
    public function metodo() {
        $view = new VInfo();
        $view->mostraMetodo();
    }

    // Mostra la pagina "Tariffe"
    public function tariffe() {
        $view = new VInfo();
        $view->mostraTariffe();
    }

    // Mostra la pagina "Contatti" e gestisce l'invio del form
    public function contatti() {
        $view = new VInfo();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = htmlspecialchars($_POST['nome']);
            $email = htmlspecialchars($_POST['email']);
            $messaggio = htmlspecialchars($_POST['messaggio']);
            
            // Mostra il template passando il messaggio di conferma
            $conferma = "Grazie $nome! Abbiamo ricevuto il tuo messaggio e ti risponderemo all'indirizzo $email.";
            $view->mostraContatti($conferma);
        } else {
            $view->mostraContatti();
        }
    }
}
?>