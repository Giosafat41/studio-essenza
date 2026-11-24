<!-- File: Smarty/templates/admin_utenti.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno al Pannello Segreteria -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al Pannello Segreteria</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Anagrafica Studio</span>
                <h1 class="dashboard-title">Gestione Utenti</h1>
                <p class="dashboard-subtitle">
                    Visualizza e aggiorna i dati completi, il saldo crediti e il certificato medico degli iscritti.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=admin&action=creaUtente" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span>Nuovo Utente</span>
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

    <!-- Tabella Utenti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Profili Registrati</h2>
            <span class="dashboard-count-badge">
                {$utenti|@count} {if $utenti|@count == 1}utente{else}utenti{/if}
            </span>
        </div>

        {if empty($utenti)}
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun utente registrato</p>
                <p class="dashboard-empty-text">Non risultano ancora utenti presenti nel sistema.</p>
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
                            <th>Crediti</th>
                            <th>Scadenza Certificato</th>
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
                                <td><strong>{$u->getCreditiResidui()}</strong></td>
                                <td>
                                    {if $u->getScadenzaCertificato()}
                                        {if $u->haCertificatoValido()}
                                            <span class="dashboard-status-pill is-confirmed">
                                                {$u->getScadenzaCertificato()|date_format:"%d/%m/%Y"}
                                            </span>
                                        {else}
                                            <span class="dashboard-status-pill is-cancelled">
                                                Scaduto ({$u->getScadenzaCertificato()|date_format:"%d/%m/%Y"})
                                            </span>
                                        {/if}
                                    {else}
                                        <span class="text-muted small">Non presente</span>
                                    {/if}
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="index.php?controller=admin&action=modificaUtente&id={$u->getId()}" class="btn btn-sm btn-outline-essenza">
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
