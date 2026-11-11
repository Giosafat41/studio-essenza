<?php
class CUtente {

    // Mostra la homepage (vetrina pubblica)
    public function home() {
        // Più avanti qui richiameremo la View (Smarty) per renderizzare la home.html
        echo "<h1>Benvenuti su Studio Essenza</h1>";
        echo "<p>Qui andrà la home page pubblica.</p>";
    }

    // Gestisce il form di registrazione
    public function registra() {
        // Verifica se i dati sono stati inviati dal form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $telefono = $_POST['telefono'];

            // Crea un nuovo oggetto Entity Utente
            $nuovoUtente = new EUtente($nome, $cognome, $email, $password, $telefono);

            // Lo salva nel database tramite Foundation
            $id = FUtente::store($nuovoUtente);

            if ($id) {
                 echo "Registrazione avvenuta con successo! Ciao $nome.";
                 // Redirect alla pagina di login o alla dashboard
            } else {
                 echo "Errore durante la registrazione.";
            }
        } else {
            // Mostra il form di registrazione (View)
            echo "<h1>Registrati</h1>";
            // ... (HTML del form)
        }
    }

    // Gestisce il login
    public function login() {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // ... (Logica di verifica email e password)
         } else {
             // Mostra il form di login (View)
             echo "<h1>Login</h1>";
             // ... (HTML del form)
         }
    }
}
?>