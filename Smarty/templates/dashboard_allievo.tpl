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

        <section class="mie-prenotazioni" style="margin-top: 30px;">
            <h2>Le tue prossime lezioni</h2>
            {if $mie_prenotazioni|@count == 0}
                <p>Non hai ancora prenotato nessuna lezione.</p>
            {else}
                <ul style="list-style: none; padding: 0;">
                {foreach from=$mie_prenotazioni item=pren}
                    <li style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <div>
                            <strong>{$pren.nome_corso}</strong><br>
                            <small>{$pren.data_ora}</small>
                        </div>
                        <form action="index.php?controller=prenotazione&action=cancella" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_prenotazione" value="{$pren.id_prenotazione}">
                            <button type="submit" class="btn-primary" style="background-color: #d9534f; padding: 8px 15px; font-size: 14px;">Disdici</button>
                        </form>
                    </li>
                {/foreach}
                </ul>
            {/if}
        </section>
    </main>
</body>
</html>
