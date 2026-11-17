<!-- File: Smarty/templates/calendario.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="calendario-container">
    <h2>Calendario Lezioni</h2>
    <p class="sottotitolo">I tuoi crediti disponibili: <strong>{$crediti}</strong></p>

    {if $calendario|@count == 0}
        <div class="alert-info">Non ci sono lezioni in programma per i prossimi 7 giorni.</div>
    {else}
        <div class="grid-lezioni">
            <!-- Cicliamo l'array preparato nel Controller -->
            {foreach from=$calendario item=lezione}
                <div class="card-lezione">
                    <h3>{$lezione.nome_corso}</h3>
                    <p class="data-ora">{$lezione.data_formattata}</p>
                    
                    <!-- Form invisibile per inviare l'ID della lezione via POST -->
                    <form action="index.php?controller=prenotazione&action=prenota" method="POST">
                        <input type="hidden" name="id_lezione" value="{$lezione.id_lezione}">
                        <button type="submit" class="btn-primary btn-prenota">Prenota Ora</button>
                    </form>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}