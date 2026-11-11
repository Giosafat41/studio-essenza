<?php
class CInfo {

    // Mostra la pagina "Il nostro Metodo"
    public function metodo() {
        echo "<h1>Il Metodo Essenza</h1>";
        echo "<p>Scopri i benefici del Pilates, tra Matwork e Reformer.</p>";
        // (Qui si richiamerà il file template metodo.html)
    }

    // Mostra la pagina "Tariffe"
    public function tariffe() {
        echo "<h1>Le nostre Tariffe</h1>";
        echo "<ul>
                <li>Lezione Singola: 20€</li>
                <li>Pacchetto 10 Ingressi: 180€</li>
              </ul>";
        echo "<p>Ricorda: l'attivazione dei pacchetti avviene in sede.</p>";
    }

    // Mostra la pagina "Contatti" e gestisce l'invio di messaggi dalla vetrina
    public function contatti() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $messaggio = $_POST['messaggio'];

            // Invia una notifica via email alla segreteria
            // mail("info@studioessenza.it", "Nuovo messaggio da $nome", $messaggio);

            echo "Grazie $nome, abbiamo ricevuto la tua richiesta di informazioni. Ti contatteremo a breve.";
        } else {
            echo "<h1>Contattaci</h1>";
            echo "<p>Vieni a trovarci o chiamaci per prenotare la tua lezione di prova.</p>";
            // ... (HTML del form di contatto)
        }
    }
}
?>