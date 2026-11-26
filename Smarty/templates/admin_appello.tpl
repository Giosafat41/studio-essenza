<!-- File: Smarty/templates/admin_appello.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container dashboard-page py-2 py-md-3">

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

    <!-- Intestazione Lezione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Gestione Lezione &amp; Appello</span>
                <h1 class="dashboard-title">{$lezione.nome_corso|escape}</h1>
                <p class="dashboard-subtitle">
                    {$lezione.data|escape} &bull; {$lezione.orario|escape} &bull; Istruttore: <strong>{$lezione.istruttore|escape}</strong>
                </p>
            </div>

            <div class="d-flex flex-column align-items-lg-end gap-2">
                <div class="calendar-status-group">
                    <div class="calendar-crediti-pill">
                        <span class="calendar-crediti-label">Iscritti</span>
                        <div class="calendar-crediti-valore">
                            {$iscritti|@count} <small>/ {$lezione.capienza_max} posti</small>
                        </div>
                    </div>
                </div>
                {if !empty($puo_eliminare_lezione)}
                    <form
                        action="index.php?controller={$controller_base|default:'admin'|escape}&action=eliminaLezione"
                        method="POST"
                        class="m-0"
                        onsubmit="return confirm('Vuoi davvero eliminare questa lezione? Eventuali allievi iscritti riceveranno il rimborso di 1 credito.');"
                    >
                        <input type="hidden" name="id_lezione" value="{$lezione.id}">
                        <button type="submit" class="btn btn-sm btn-disdici">Elimina Lezione</button>
                    </form>
                {/if}
            </div>
        </div>
    </section>

    <!-- Messaggi di conferma / errore -->
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

    <!-- Cambio Istruttore -->
    {if !empty($istruttori)}
        <section class="dashboard-card mb-4">
            <h2 class="dashboard-section-title mb-3">Cambia Istruttore Assegnato</h2>
            <form
                action="index.php?controller={$controller_base|default:'admin'|escape}&action=cambiaIstruttoreLezione"
                method="POST"
                class="row g-3 align-items-end"
            >
                <input type="hidden" name="id_lezione" value="{$lezione.id}">
                <div class="col-12 col-md-8">
                    <label for="id_istruttore" class="form-label auth-label">Istruttore per questa lezione</label>
                    <select id="id_istruttore" name="id_istruttore" class="form-select admin-select" required>
                        {foreach from=$istruttori item=istr}
                            <option value="{$istr->getId()}" {if $istr->getId() == $lezione.id_istruttore}selected{/if}>
                                {$istr->getNome()|escape} {$istr->getCognome()|escape}
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-primary admin-action-btn w-100">
                        Aggiorna Istruttore
                    </button>
                </div>
            </form>
        </section>
    {/if}

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
                            <th class="text-end">Azione</th>
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
                                <td class="text-end text-nowrap">
                                    <form
                                        action="index.php?controller={$controller_base|default:'admin'|escape}&action=disiscriviAllievo"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Vuoi disiscrivere {$allievo.nome|escape:'javascript'} {$allievo.cognome|escape:'javascript'} da questa lezione? Verrà rimborsato 1 credito.');"
                                    >
                                        <input type="hidden" name="id_lezione" value="{$lezione.id}">
                                        <input type="hidden" name="id_prenotazione" value="{$allievo.id_prenotazione}">
                                        <button type="submit" class="btn btn-sm btn-disdici">Disiscrivi</button>
                                    </form>
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
