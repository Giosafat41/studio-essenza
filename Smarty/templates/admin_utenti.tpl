<!-- File: Smarty/templates/admin_utenti.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="dashboard-wrapper" style="max-width: 1150px;">
    
    <div class="dashboard-welcome">
        <div>
            <h1>Anagrafica Utenti Iscritti</h1>
            <p class="sottotitolo">Visualizza e modifica i dati completi, i crediti e il certificato medico di ogni utente.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="index.php?controller=admin&action=creaUtente" class="btn-primary">+ Nuovo Utente</a>
            <a href="index.php?controller=admin&action=dashboard" class="btn-primary" style="background-color: #6c757d;">&larr; Dashboard</a>
        </div>
    </div>

    {if isset($messaggio_successo)}
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-weight: bold;">
            {$messaggio_successo}
        </div>
    {/if}

    <div class="dashboard-card" style="overflow-x: auto;">
        {if empty($utenti)}
            <p>Nessun utente registrato nel sistema.</p>
        {else}
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #7b8b6f; color: #7b8b6f;">
                        <th style="padding: 12px 8px;">ID</th>
                        <th style="padding: 12px 8px;">Nome e Cognome</th>
                        <th style="padding: 12px 8px;">Email</th>
                        <th style="padding: 12px 8px;">Telefono</th>
                        <th style="padding: 12px 8px;">Ruolo</th>
                        <th style="padding: 12px 8px;">Crediti</th>
                        <th style="padding: 12px 8px;">Scadenza Certificato</th>
                        <th style="padding: 12px 8px;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$utenti item=u}
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px 8px;">#{$u->getId()}</td>
                            <td style="padding: 12px 8px;"><strong>{$u->getCognome()} {$u->getNome()}</strong></td>
                            <td style="padding: 12px 8px;">{$u->getEmail()}</td>
                            <td style="padding: 12px 8px;">{$u->getTelefono()|default:'-'}</td>
                            <td style="padding: 12px 8px;">
                                <span style="text-transform: uppercase; font-size: 12px; font-weight: bold; padding: 3px 8px; border-radius: 4px; background: #f0f0f0;">
                                    {$u->getRuolo()}
                                </span>
                            </td>
                            <td style="padding: 12px 8px; font-weight: bold;">{$u->getCreditiResidui()}</td>
                            <td style="padding: 12px 8px;">
                                {if $u->getScadenzaCertificato()}
                                    {if $u->haCertificatoValido()}
                                        <span style="color: #28a745; font-weight: bold;">{$u->getScadenzaCertificato()|date_format:"%d/%m/%Y"}</span>
                                    {else}
                                        <span style="color: #d9534f; font-weight: bold;">Scaduto ({$u->getScadenzaCertificato()|date_format:"%d/%m/%Y"})</span>
                                    {/if}
                                {else}
                                    <span style="color: #999;">Non presente</span>
                                {/if}
                            </td>
                            <td style="padding: 12px 8px;">
                                <a href="index.php?controller=admin&action=modificaUtente&id={$u->getId()}" class="btn-primary" style="padding: 6px 12px; font-size: 13px;">Modifica</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        {/if}
    </div>

</div>
{/block}