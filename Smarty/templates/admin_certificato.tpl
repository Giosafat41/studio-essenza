<!-- File: Smarty/templates/admin_certificato.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container">
    <h2>Registra Certificato Medico</h2>
    <p class="sottotitolo">Inserisci la data di scadenza del certificato medico consegnato in segreteria.</p>
    
    {if isset($messaggio_successo)}
        <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 15px;">
            {$messaggio_successo}
        </div>
    {/if}
    {if isset($messaggio_errore)}
        <div class="alert-error" style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 15px;">
            {$messaggio_errore}
        </div>
    {/if}

    <form action="index.php?controller=admin&action=aggiornaCertificato" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email_allievo">Email Allievo</label>
            <input type="email" id="email_allievo" name="email_allievo" required placeholder="es. mario.rossi@email.com">
        </div>
        
        <div class="form-group">
            <label for="scadenza_certificato">Data di Scadenza Certificato</label>
            <input type="date" id="scadenza_certificato" name="scadenza_certificato" required>
        </div>
        
        <button type="submit" class="btn-primary">Salva Scadenza</button>
    </form>
    
    <p class="form-footer"><a href="index.php?controller=admin&action=dashboard">&larr; Torna alla Dashboard Segreteria</a></p>
</div>

<!-- Blocco 4: Certificato Medico -->
        <div class="card-tariffa">
            <h3>Certificato Medico</h3>
            <p class="desc">Registra o aggiorna la data di scadenza del certificato medico di un allievo.</p>
            <br>
            <a href="index.php?controller=admin&action=aggiornaCertificato" class="btn-primary">Gestisci Certificati</a>
        </div>
{/block}