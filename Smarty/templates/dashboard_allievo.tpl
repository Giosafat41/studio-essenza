<!-- File: Smarty/templates/dashboard_allievo.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-4" style="max-width: 960px;">

    <!-- Intestazione -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h3 mb-1" style="color: #7b8b6f;">Bentornato/a, {$nome_utente}!</h1>
            <p class="text-muted mb-0">Gestisci il tuo saldo crediti, i corsi di gruppo e le lezioni individuali.</p>
        </div>
        <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary" style="background-color: #7b8b6f; border-color: #7b8b6f;">
            + Prenota una nuova lezione
        </a>
    </div>

    <!-- Messaggi di conferma / errore -->
    {if isset($messaggio_successo)}
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {$messaggio_successo}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}
    {if isset($messaggio_errore)}
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {$messaggio_errore}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}

    <!-- Saldo Crediti -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Il tuo Saldo Attuale</h2>
        <p class="fs-3 fw-bold mb-2" style="color: #4a4a4a;">{$crediti} lezioni disponibili</p>

        {if $avviso_crediti}
            <div class="alert alert-warning mb-0 mt-3" role="alert">
                <strong>Attenzione:</strong> i tuoi ingressi stanno per esaurirsi.
                Ricordati di passare in segreteria per il rinnovo!
            </div>
        {/if}
    </div>

    <!-- Sezione Lezioni Individuali (1-to-1) -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Le tue Lezioni Individuali (1-to-1)</h2>

        {if empty($lezioni_individuali)}
            <p class="text-muted mb-0">Non hai ancora prenotato alcuna lezione individuale.</p>
        {else}
            <div class="list-group">
                {foreach $lezioni_individuali as $ind}
                    <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-3 py-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <strong>Istruttore: {$ind.istruttore}</strong>
                                {if $ind.stato == 'prenotata'}
                                    <span class="badge bg-success">Prenotata</span>
                                {else}
                                    <span class="badge bg-danger">Annullata dall'istruttore</span>
                                {/if}
                            </div>
                            <div class="text-muted small">
                                {$ind.data} &bull; {$ind.ora_inizio} - {$ind.ora_fine}
                            </div>
                            {if $ind.stato == 'annullata_istruttore'}
                                <div class="mt-2 small text-danger">
                                    <strong>Motivazione:</strong> {$ind.motivazione|default:'Nessuna motivazione specificata.'}
                                    <br>
                                    <span class="text-muted">1 credito è stato rimborsato automaticamente sul tuo profilo.</span>
                                </div>
                            {/if}
                        </div>

                        {if $ind.stato == 'prenotata'}
                            <form action="index.php?controller=prenotazione&action=cancellaIndividuale" method="POST" class="m-0">
                                <input type="hidden" name="id_slot" value="{$ind.id}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Disdici</button>
                            </form>
                        {/if}
                    </div>
                {/foreach}
            </div>
        {/if}
    </div>

    <!-- Sezione Corsi di Gruppo Prenotati -->
    <div class="bg-white rounded-3 shadow-sm p-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">I tuoi Corsi di Gruppo Prenotati</h2>

        {if empty($mie_prenotazioni)}
            <p class="text-muted mb-0">Non hai ancora prenotato nessuna lezione di gruppo.</p>
        {else}
            <div class="list-group">
                {foreach from=$mie_prenotazioni item=pren}
                    <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap gap-3 py-3">
                        <div>
                            <strong>{$pren.nome_corso}</strong><br>
                            <small class="text-muted">{$pren.data_ora}</small>
                        </div>
                        <form action="index.php?controller=prenotazione&action=cancella" method="POST" class="m-0">
                            <input type="hidden" name="id_prenotazione" value="{$pren.id_prenotazione}">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Disdici</button>
                        </form>
                    </div>
                {/foreach}
            </div>
        {/if}
    </div>

</div>
{/block}
