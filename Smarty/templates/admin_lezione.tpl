<!-- File: Smarty/templates/admin_lezione.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container">
    <h2>Programma Nuova Lezione</h2>
    <p class="sottotitolo">Inserisci una nuova classe nel calendario dello studio.</p>
    
    {if isset($messaggio_successo)}
        <div class="alert-success" style="color: green; margin-bottom:15px; font-weight:bold;">{$messaggio_successo}</div>
    {/if}

    <form action="index.php?controller=admin&action=aggiungiLezione" method="POST" class="auth-form">
        
        <div class="form-group">
            <label for="id_corso">Tipo di Corso</label>
            <select id="id_corso" name="id_corso" required>
                {foreach from=$corsi item=corso}
                    <option value="{$corso->getId()}">{$corso->getNome()} (Max {$corso->getCapienzaMax()} posti)</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="id_istruttore">Istruttore</label>
            <select id="id_istruttore" name="id_istruttore" required>
                {foreach from=$istruttori item=istr}
                    <option value="{$istr->getId()}">{$istr->getNome()} {$istr->getCognome()}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="data_ora_inizio">Data e Ora di Inizio</label>
            <!-- L'input datetime-local apre il calendario nativo del browser -->
            <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" required>
        </div>

        <div class="form-group">
            <label for="data_ora_fine">Data e Ora di Fine</label>
            <input type="datetime-local" id="data_ora_fine" name="data_ora_fine" required>
        </div>
        
        <button type="submit" class="btn-primary">Salva a Calendario</button>
    </form>
    
    <p class="form-footer"><a href="index.php?controller=admin&action=dashboard">&larr; Torna alla Dashboard</a></p>
</div>
{/block}