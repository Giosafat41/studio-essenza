<?php
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
<!-- File: Smarty/templates/dashboard_allievo.tpl -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Allievo</title>
    <!-- Collegamento al CSS nella cartella Smarty -->
    <link rel="stylesheet" href="Smarty/css/general.css">
</head>
<body>
    <header class="header-boutique">
        <h1>Studio Essenza</h1>
        <p>Bentornato, {$nome_utente}!</p>
    </header>

    <main class="dashboard-container">
        <section class="saldo-crediti">
            <h2>Il tuo Saldo Attuale</h2>
            <p class="numero-grande">{$crediti} lezioni disponibili</p>

            <!-- Logica if/else direttamente in HTML tramite Smarty -->
            {if $avviso_crediti}
                <div class="avviso-rinnovo">
                    <strong>Attenzione:</strong> i tuoi ingressi stanno per esaurirsi. 
                    Ricordati di passare in segreteria per il rinnovo!
                </div>
            {/if}
        </section>

        <section class="azioni-rapide">
            <a href="?controller=prenotazione&action=calendario" class="bottone-prenota">Prenota una nuova lezione</a>
        </section>
    </main>
</body>
</html>
