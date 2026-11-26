<!-- File: Smarty/templates/admin_utenti.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno alla Dashboard -->
    <div class="mb-3">
        <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al {$label_dashboard|default:'Pannello'|escape}</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">{$badge_sezione|default:'Anagrafica Studio'|escape}</span>
                <h1 class="dashboard-title">{$titolo_sezione|default:'Gestione Utenti'|escape}</h1>
                <p class="dashboard-subtitle">
                    {$sottotitolo_sezione|default:'Visualizza e aggiorna i profili registrati.'|escape}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=creaUtente" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span>{$label_nuovo|default:'Nuovo Utente'|escape}</span>
                </a>
            </div>
        </div>
    </section>

    {if isset($messaggio_successo)}
        <div class="alert auth-alert-success fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span>{$messaggio_successo|escape}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}
    {if isset($messaggio_errore)}
        <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span>{$messaggio_errore|escape}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}

    <!-- Tabella Utenti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Profili</h2>
            <span class="dashboard-count-badge">
                {$utenti|@count} {if $utenti|@count == 1}profilo{else}profili{/if}
            </span>
        </div>

        {if empty($utenti)}
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun profilo presente</p>
                <p class="dashboard-empty-text">Non risultano ancora profili registrati in questa sezione.</p>
            </div>
        {else}
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Ruolo</th>
                            {if !empty($mostra_colonne_allievo)}
                                <th>Crediti</th>
                                <th>Scadenza Certificato</th>
                            {else}
                                <th>Tariffa 1-to-1</th>
                            {/if}
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$utenti item=u}
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="admin-avatar-sm">
                                            {if $u->getImmagineProfilo()}
                                                <img src="/studio-essenza/{$u->getImmagineProfilo()|escape}" alt="{$u->getNome()|escape} {$u->getCognome()|escape}">
                                            {else}
                                                {$u->getNome()|substr:0:1|upper}{$u->getCognome()|substr:0:1|upper}
                                            {/if}
                                        </span>
                                        <strong>{$u->getCognome()|escape} {$u->getNome()|escape}</strong>
                                    </div>
                                </td>
                                <td>{$u->getEmail()|escape}</td>
                                <td>{$u->getTelefono()|default:'-'|escape}</td>
                                <td>
                                    <span class="admin-role-pill is-{$u->getRuolo()|escape}">
                                        {$u->getRuolo()|escape}
                                    </span>
                                </td>
                                {if !empty($mostra_colonne_allievo)}
                                    <td>
                                        {if $u->getRuolo() == 'allievo'}
                                            <strong>{$u->getCreditiResidui()}</strong>
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                    <td>
                                        {if $u->getRuolo() == 'allievo'}
                                            {if $u->getScadenzaCertificato()}
                                                {if $u->haCertificatoValido()}
                                                    <span class="dashboard-status-pill is-confirmed">
                                                        {$u->getScadenzaCertificatoFormattata()|escape}
                                                    </span>
                                                {else}
                                                    <span class="dashboard-status-pill is-cancelled">
                                                        Scaduto ({$u->getScadenzaCertificatoFormattata()|escape})
                                                    </span>
                                                {/if}
                                            {else}
                                                <span class="text-muted small">Non presente</span>
                                            {/if}
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                {else}
                                    <td>
                                        {if $u->getRuolo() == 'istruttore'}
                                            {if $u->getTariffaFormattata()}
                                                <strong>{$u->getTariffaFormattata()|escape}</strong>
                                            {else}
                                                <span class="text-muted small">Su richiesta</span>
                                            {/if}
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                {/if}
                                <td class="text-end text-nowrap">
                                    <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=modificaUtente&id={$u->getId()}" class="btn btn-sm btn-outline-essenza">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
    </section>

</div>
{/block}
