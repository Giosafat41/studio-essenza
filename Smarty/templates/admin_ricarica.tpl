<!-- File: Smarty/templates/admin_ricarica.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container">
    <h2>Ricarica Crediti Allievo</h2>
    <p class="sottotitolo">Aggiungi pacchetti ingressi dopo il pagamento in sede.</p>
    
    {if isset($messaggio_successo)}
        <div class="alert-success" style="color: green; margin-bottom:15px; font-weight:bold;">{$messaggio_successo}</div>
    {/if}
    {if isset($messaggio_errore)}
        <div class="alert-error" style="color: red; margin-bottom:15px; font-weight:bold;">{$messaggio_errore}</div>
    {/if}

    <form action="index.php?controller=admin&action=ricaricaCrediti" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email_allievo">Email Allievo</label>
            <input type="email" id="email_allievo" name="email_allievo" required placeholder="es. mario.rossi@email.com">
        </div>
        
        <div class="form-group">
            <label for="quantita_crediti">Crediti da aggiungere</label>
            <select id="quantita_crediti" name="quantita_crediti" required>
                <option value="1">1 Lezione (Singola)</option>
                <option value="5">5 Lezioni (Pacchetto Base)</option>
                <option value="10">10 Lezioni (Pacchetto Premium)</option>
            </select>
        </div>
        
        <button type="submit" class="btn-primary">Aggiorna Saldo</button>
    </form>
    
    <p class="form-footer"><a href="index.php?controller=admin&action=dashboard">&larr; Torna alla Dashboard</a></p>
</div>
{/block}