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
