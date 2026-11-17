<!-- File: Smarty/templates/dashboard_allievo.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="dashboard-wrapper">
    
    <!-- Intestazione Benvenuto -->
    <div class="dashboard-welcome">
        <div>
            <h1>Ciao, {$nome_utente} {$cognome_utente}!</h1>
            <p class="sottotitolo">Gestisci i tuoi ingressi e le tue prenotazioni in Studio Essenza.</p>
        </div>
        <a href="index.php?controller=prenotazione&action=calendario" class="btn-primary">+ Prenota una Lezione</a>
    </div>

    <!-- Griglia Superiore: Crediti e Riepilogo Profilo -->
    <div class="dashboard-grid">
        
        <!-- Card Saldo Crediti -->
        <div class="dashboard-card">
            <h3>Il tuo Saldo Ingressi</h3>
            <div class="crediti-badge">{$crediti}</div>
            <p class="desc">lezioni disponibili sul tuo profilo</p>
            
            {if $avviso_crediti}
                <div class="avviso-rinnovo">
                    <strong>Ingressi in esaurimento:</strong> passa in segreteria per attivare un nuovo pacchetto lezioni.
                </div>
            {/if}
        </div>

        <!-- Card Dati Personali -->
        <div class="dashboard-card">
            <h3>Il tuo Profilo</h3>
            <ul class="profilo-lista">
                <li><strong>Nome e Cognome:</strong> {$nome_utente} {$cognome_utente}</li>
                <li><strong>Email:</strong> {$email_utente}</li>
                <li><strong>Telefono:</strong> {$telefono_utente|default:'Non inserito'}</li>
                <li>
                    <strong>Certificato Medico:</strong> 
                    {if $scadenza_certificato}
                        Scadenza {$scadenza_certificato}
                    {else}
                        <span style="color: #d9534f;">Da consegnare in segreteria</span>
                    {/if}
                </li>
            </ul>
        </div>

    </div>

    <!-- Sezione Prenotazioni Attive -->
    <div class="dashboard-card" style="margin-top: 30px;">
        <h3>Le tue prossime lezioni</h3>
        
        {if empty($mie_prenotazioni)}
            <p class="desc">Non hai ancora prenotazioni attive. Clicca su "Prenota una Lezione" per scegliere il tuo posto a calendario.</p>
        {else}
            <div class="lista-prenotazioni">
                {foreach from=$mie_prenotazioni item=pren}
                    <div class="riga-prenotazione">
                        <div class="info-prenotazione">
                            <span class="corso-titolo">{$pren.nome_corso}</span>
                            <span class="corso-meta">Data: <strong>{$pren.data_ora}</strong> &bull; Istruttore: {$pren.nome_istruttore}</span>
                        </div>
                        <form action="index.php?controller=prenotazione&action=cancella" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_prenotazione" value="{$pren.id_prenotazione}">
                            <button type="submit" class="btn-danger">Disdici</button>
                        </form>
                    </div>
                {/foreach}
            </div>
        {/if}
    </div>

</div>
{/block}