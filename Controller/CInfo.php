
<?php
// File: Controller/CInfo.php

class CInfo {
    
    // Mostra la pagina "Il nostro Metodo"
    public function metodo() {
        $view = new VInfo();
        $view->mostraMetodo();
    }

    // Mostra la pagina "Tariffe" con i pacchetti e le tariffe individuali di ogni istruttore dal DB
    public function tariffe() {
        $istruttori_entity = FUtente::loadSoloIstruttori();
        $istruttori_tariffe = [];

        foreach ($istruttori_entity as $istr) {
            $iniziali = strtoupper(
                substr($istr->getNome(), 0, 1) . substr($istr->getCognome(), 0, 1)
            );
            $istruttori_tariffe[] = [
                'id' => $istr->getId(),
                'nome' => $istr->getNome(),
                'cognome' => $istr->getCognome(),
                'iniziali' => $iniziali,
                'immagine_profilo' => $istr->getImmagineProfilo(),
                'descrizione' => $istr->getDescrizione(),
                'tariffa_individuale' => $istr->getTariffaIndividuale(),
                'tariffa_formattata' => $istr->getTariffaFormattata()
            ];
        }

        $view = new VInfo();
        $view->mostraTariffe($istruttori_tariffe);
    }

    // Mostra la pagina "Contatti" e gestisce l'invio del form
    public function contatti() {
        $view = new VInfo();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_raw = trim($_POST['nome'] ?? '');
            $email_raw = trim($_POST['email'] ?? '');
            $messaggio_raw = trim($_POST['messaggio'] ?? '');

            if ($nome_raw === '') {
                $view->mostraContatti(null, "Inserisci il tuo nome.");
                return;
            }
            if ($email_raw === '') {
                $view->mostraContatti(null, "Inserisci il tuo indirizzo email.");
                return;
            }
            if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
                $view->mostraContatti(null, "Inserisci un indirizzo email valido.");
                return;
            }
            if ($messaggio_raw === '') {
                $view->mostraContatti(null, "Scrivi il messaggio che desideri inviarci.");
                return;
            }

            $nome = htmlspecialchars($nome_raw);
            $email = htmlspecialchars($email_raw);
            $messaggio = htmlspecialchars($messaggio_raw);
            
            // Mostra il template passando il messaggio di conferma
            $conferma = "Grazie $nome! Abbiamo ricevuto il tuo messaggio e ti risponderemo all'indirizzo $email.";
            $view->mostraContatti($conferma);
        } else {
            $view->mostraContatti();
        }
    }
}
?>