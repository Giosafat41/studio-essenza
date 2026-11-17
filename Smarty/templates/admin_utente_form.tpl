<!-- File: Smarty/templates/admin_utente_form.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="dashboard-wrapper" style="max-width: 650px;">
    <div class="dashboard-card">
        
        {if isset($utente)}
            <h2>Modifica Utente #{$utente->getId()}</h2>
            <p class="sottotitolo">Aggiorna i dati anagrafici, i crediti o la scadenza del certificato medico.</p>
        {else}
            <h2>Crea Nuovo Utente</h2>
            <p class="sottotitolo">Registra un nuovo allievo, istruttore o amministratore.</p>
        {/if}

        {if isset($messaggio_errore)}
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                {$messaggio_errore}
            </div>
        {/if}

        <form action="index.php?controller=admin&action={if isset($utente)}modificaUtente{else}creaUtente{/if}" method="POST" class="auth-form">
            
            {if isset($utente)}
                <input type="hidden" name="id" value="{$utente->getId()}">
            {/if}

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nome" style="display:block; margin-bottom:5px; font-weight:bold;">Nome</label>
                <input type="text" id="nome" name="nome" required value="{if isset($utente)}{$utente->getNome()}{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="cognome" style="display:block; margin-bottom:5px; font-weight:bold;">Cognome</label>
                <input type="text" id="cognome" name="cognome" required value="{if isset($utente)}{$utente->getCognome()}{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="email" style="display:block; margin-bottom:5px; font-weight:bold;">Email</label>
                <input type="email" id="email" name="email" required value="{if isset($utente)}{$utente->getEmail()}{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            {if !isset($utente)}
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="password" style="display:block; margin-bottom:5px; font-weight:bold;">Password Iniziale</label>
                    <input type="password" id="password" name="password" required placeholder="Imposta una password per l'utente" style="width:100%; padding:10px; box-sizing:border-box;">
                </div>
            {/if}

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="telefono" style="display:block; margin-bottom:5px; font-weight:bold;">Telefono</label>
                <input type="tel" id="telefono" name="telefono" value="{if isset($utente)}{$utente->getTelefono()}{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="ruolo" style="display:block; margin-bottom:5px; font-weight:bold;">Ruolo nel Sistema</label>
                <select id="ruolo" name="ruolo" required style="width:100%; padding:10px; box-sizing:border-box;">
                    <option value="allievo" {if isset($utente) && $utente->getRuolo() == 'allievo'}selected{/if}>Allievo</option>
                    <option value="istruttore" {if isset($utente) && $utente->getRuolo() == 'istruttore'}selected{/if}>Istruttore</option>
                    <option value="admin" {if isset($utente) && $utente->getRuolo() == 'admin'}selected{/if}>Admin (Segreteria)</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="crediti_residui" style="display:block; margin-bottom:5px; font-weight:bold;">Crediti Residui</label>
                <input type="number" id="crediti_residui" name="crediti_residui" min="0" required value="{if isset($utente)}{$utente->getCreditiResidui()}{else}0{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label for="scadenza_certificato" style="display:block; margin-bottom:5px; font-weight:bold;">Scadenza Certificato Medico</label>
                <input type="date" id="scadenza_certificato" name="scadenza_certificato" value="{if isset($utente)}{$utente->getScadenzaCertificato()}{/if}" style="width:100%; padding:10px; box-sizing:border-box;">
                <small style="color: #777;">Lascia vuoto se il certificato non è ancora stato consegnato.</small>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-primary">
                    {if isset($utente)}Salva Modifiche{else}Crea Utente{/if}
                </button>
                <a href="index.php?controller=admin&action=utenti" class="btn-primary" style="background-color: #6c757d;">Annulla</a>
            </div>
        </form>

    </div>
</div>
{/block}