<?php
class CFrontController {

    public function run() {
        // Legge i parametri 'controller' e 'action' dall'URL
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'utente';
        $action = isset($_GET['action']) ? $_GET['action'] : 'home';

        // Mappa i nomi dei controller nell'URL alle classi reali
        switch ($controller) {
            case 'utente':
                $controllerClass = 'CUtente';
                break;
            case 'prenotazione':
                $controllerClass = 'CPrenotazione';
                break;
            case 'admin':
                $controllerClass = 'CAdmin';
                break;
            case 'info':                     // <-- ECCO IL BLOCCO AGGIUNTO
                $controllerClass = 'CInfo';
                break;
            default:
                // Se il controller non è riconosciuto, mostra un errore
                $this->mostraErrore("Controller non valido.");
                return;
        }

        // Verifica se la classe del controller esiste
        if (class_exists($controllerClass)) {
            $controllerObj = new $controllerClass();
            // Verifica se il metodo (azione) esiste nella classe
            if (method_exists($controllerObj, $action)) {
                // Esegue il metodo
                $controllerObj->$action();
            } else {
                $this->mostraErrore("Azione non trovata nel controller.");
            }
        } else {
             $this->mostraErrore("Classe del controller non trovata.");
        }
    }

    private function mostraErrore($messaggio) {
        echo "<h1>Errore di Routing</h1>";
        echo "<p>$messaggio</p>";
    }
}
?>
