<!-- File: Smarty/templates/admin_appello.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="dashboard-container">
    <h2>Registro Iscritti</h2>
    <p class="sottotitolo">Lezione: <strong>{$dettagli_lezione}</strong></p>
    
    <div style="background: white; padding: 20px; border-radius: 8px; margin-top:20px;">
        {if $iscritti|@count == 0}
            <p>Nessun allievo ancora prenotato per questa lezione.</p>
        {else}
            <table style="width: 100%; text-align: left; border-collapse: collapse;">
                <tr style="border-bottom: 2px solid #eee;">
                    <th style="padding: 10px 0;">Nome e Cognome</th>
                    <th style="padding: 10px 0;">Telefono</th>
                </tr>
                {foreach from=$iscritti item=allievo}
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 0;">{$allievo.nome} {$allievo.cognome}</td>
                    <td style="padding: 10px 0;">{$allievo.telefono|default:'-'}</td>
                </tr>
                {/foreach}
            </table>
        {/if}
    </div>
    
    <p style="margin-top:20px;"><a href="index.php?controller=admin&action=dashboard" class="btn-primary">&larr; Torna alla Dashboard</a></p>
</div>
{/block}