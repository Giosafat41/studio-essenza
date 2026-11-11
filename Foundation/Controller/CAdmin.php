<?php
class CAdmin {
    
    // Mostra la dashboard principale della segreteria
    public function dashboard() {
        // (In futuro) Controllo di sicurezza: se l'utente non è admin, lo rimanda alla home
        
        echo "<h1>Pannello di Controllo - Studio Essenza</h1>";
        echo "<p>Benvenuto in Segreteria. Scegli un'operazione:</p>";
        // ... (HTML con pulsanti per Gestione Utenti, Gestione Calendario, ecc.)
    }

    // Azione per ricaricare manualmente i crediti di un allievo (dopo pagamento in sede)
    public function ricaricaCrediti() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_utente = $_POST['id_utente'];
            $quantita_crediti = $_POST['quantita'];

            // 1. Carica l'utente dal database tramite il livello Foundation
            $utente = FUtente::load($id_utente);
            
            if ($utente) {
                // 2. Modifica i crediti nell'oggetto Entity
                $utente->ricaricaCrediti($quantita_crediti);
                
                // 3. Salva la modifica nel database
                // (Qui supponiamo di avere un metodo update() in FUtente)
                $esito = FUtente::update($utente); 
                
                if ($esito) {
                    echo "Ricarica effettuata! Il nuovo saldo di " . $utente->getNome() . " è: " . $utente->getCreditiResidui();
                } else {
                    echo "Errore durante l'aggiornamento nel database.";
                }
            } else {
                echo "Utente non trovato.";
            }
        } else {
            // Mostra il form di ricarica
            echo "<h2>Ricarica Crediti Allievo</h2>";
            // ... (HTML del form)
        }
    }

    // Azione per creare una nuova lezione a calendario
    public function aggiungiLezione() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_corso = $_POST['id_corso'];
            $id_istruttore = $_POST['id_istruttore'];
            $data_inizio = $_POST['data_ora_inizio'];
            $data_fine = $_POST['data_ora_fine'];

            $lezione = new ELezione($id_corso, $id_istruttore, $data_inizio, $data_fine);
            $id_lezione = FLezione::store($lezione);

            echo "Lezione inserita con successo a calendario (ID: $id_lezione).";
        }
    }
}
?>