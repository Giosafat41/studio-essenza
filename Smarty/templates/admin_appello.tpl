<!-- File: Smarty/templates/admin_appello.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container dashboard-page py-2 py-md-3">

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

    <!-- Intestazione Lezione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Registro Appello</span>
                <h1 class="dashboard-title">{$lezione.nome_corso|escape}</h1>
                <p class="dashboard-subtitle">
                    {$lezione.data|escape} &bull; {$lezione.orario|escape} &bull; Istruttore: <strong>{$lezione.istruttore|escape}</strong>
                </p>
            </div>

            <div class="calendar-status-group">
                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Iscritti</span>
                    <div class="calendar-crediti-valore">
                        {$iscritti|@count} <small>/ {$lezione.capienza_max} posti</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Elenco Iscritti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Allievi Prenotati</h2>
            <span class="dashboard-count-badge">
                {$iscritti|@count} {if $iscritti|@count == 1}partecipante{else}partecipanti{/if}
            </span>
        </div>

        {if empty($iscritti)}
            <div class="dashboard-empty">
                <div class="dashboard-empty-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="17" y1="8" x2="23" y2="14"></line>
                        <line x1="23" y1="8" x2="17" y2="14"></line>
                    </svg>
                </div>
                <p class="dashboard-empty-title">Nessun allievo prenotato</p>
                <p class="dashboard-empty-text">
                    Al momento non risultano prenotazioni confermate per questa lezione.
                </p>
            </div>
        {else}
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Allievo</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Certificato Medico</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $iscritti as $allievo}
                            <tr>
                                <td class="text-muted">{$allievo@iteration}</td>
                                <td><strong>{$allievo.cognome|escape} {$allievo.nome|escape}</strong></td>
                                <td>{$allievo.telefono|default:'-'|escape}</td>
                                <td>{$allievo.email|escape}</td>
                                <td>
                                    {if $allievo.certificato_valido}
                                        <span class="dashboard-status-pill is-confirmed">Valido</span>
                                    {else}
                                        <span class="dashboard-status-pill is-cancelled">Scaduto / Assente</span>
                                    {/if}
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
