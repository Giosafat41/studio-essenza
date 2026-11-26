<!-- File: Smarty/templates/segretaria_dashboard.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container dashboard-page py-2 py-md-3">

    <!-- Intestazione Hero Segreteria -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Area Segreteria</span>
                <h1 class="dashboard-title">Pannello Segreteria</h1>
                <p class="dashboard-subtitle">
                    Benvenuto/a, <strong>{$nome_segretaria|escape}</strong>. Gestisci allievi, istruttori e le lezioni in programma di Studio Essenza.
                </p>
            </div>

            <div class="d-flex flex-column align-items-lg-end gap-2">
                <div class="calendar-status-group">
                    <div class="calendar-crediti-pill">
                        <span class="calendar-crediti-label">Allievi e Istruttori</span>
                        <div class="calendar-crediti-valore">
                            {$totale_utenti}
                            <small>{if $totale_utenti == 1}profilo{else}profili{/if}</small>
                        </div>
                    </div>

                    <div class="calendar-crediti-pill {if empty($lezioni_disponibili)}is-empty{/if}">
                        <span class="calendar-crediti-label">Lezioni attive</span>
                        <div class="calendar-crediti-valore">
                            {$lezioni_disponibili|@count}
                            <small>{if $lezioni_disponibili|@count == 1}lezione{else}lezioni{/if}</small>
                        </div>
                    </div>
                </div>
                <a href="index.php?controller=utente&action=cambiaPassword" class="btn btn-outline-essenza btn-sm">
                    Cambia Password
                </a>
            </div>
        </div>
    </section>

    <!-- Avviso promemoria cambio password iniziale -->
    {if !empty($mostra_avviso_password)}
        <div class="alert password-reminder-alert fade show d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4" id="avvisoCambioPassword" role="alert">
            <div class="d-flex align-items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <div>
                    <strong class="d-block mb-1">Ricordati di cambiare la tua password</strong>
                    <span>Il tuo profilo segreteria usa ancora la password iniziale impostata dall'amministratore. Ti consigliamo di impostarne una personale.</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <a href="index.php?controller=utente&action=cambiaPassword" class="btn btn-primary btn-sm px-3 text-nowrap">
                    Cambia password
                </a>
                <button
                    type="button"
                    class="btn btn-outline-essenza btn-sm px-3 text-nowrap js-chiudi-avviso-password"
                    data-bs-dismiss="alert"
                    aria-label="Chiudi avviso"
                >
                    Chiudi
                </button>
            </div>
        </div>
    {/if}

    <!-- Eventuali messaggi di conferma o errore -->
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

    <!-- Griglia Strumenti di Segreteria -->
    <div class="row g-4 align-items-stretch">

        <!-- Card 1: Gestione Utenti (Allievi e Istruttori) -->
        <div class="col-12 col-lg-6">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="admin-card-icon mb-3" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>

                <h2 class="admin-card-title">Gestione Utenti</h2>
                <p class="admin-card-desc">
                    Visualizza allievi e istruttori, aggiorna anagrafica, crediti residui e certificati medici oppure registra nuovi profili.
                </p>

                <div class="mt-auto pt-3 d-flex flex-column gap-2">
                    <a href="index.php?controller=segretaria&action=utenti" class="btn btn-primary admin-action-btn w-100">
                        Lista Utenti
                    </a>
                    <a href="index.php?controller=segretaria&action=creaUtente" class="btn btn-outline-essenza admin-action-btn w-100">
                        + Nuovo Utente
                    </a>
                </div>
            </section>
        </div>

        <!-- Card 2: Gestione Lezioni Esistenti & Appello -->
        <div class="col-12 col-lg-6">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="admin-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
                            <rect x="9" y="3" width="6" height="4" rx="1"></rect>
                            <path d="m9 14 2 2 4-4"></path>
                        </svg>
                    </div>
                    <span class="dashboard-count-badge">
                        {$lezioni_disponibili|@count} {if $lezioni_disponibili|@count == 1}attiva{else}attive{/if}
                    </span>
                </div>

                <h2 class="admin-card-title">Gestione Lezioni &amp; Appello</h2>
                <p class="admin-card-desc">
                    Scegli una lezione in programma per consultare gli iscritti, disiscrivere un allievo o sostituire l'istruttore assegnato.
                </p>

                <div class="mt-auto pt-3">
                    {if empty($lezioni_disponibili)}
                        <div class="admin-empty-inline">
                            <p class="mb-0">Nessuna lezione attiva in programma al momento.</p>
                        </div>
                    {else}
                        <form action="index.php" method="GET" class="admin-appello-form">
                            <input type="hidden" name="controller" value="segretaria">
                            <input type="hidden" name="action" value="appello">

                            <div class="mb-3">
                                <label for="id_lezione" class="form-label auth-label">Lezione disponibile</label>
                                <select id="id_lezione" name="id_lezione" class="form-select admin-select" required data-msg-required="Seleziona una lezione dal menù a tendina prima di procedere.">
                                    <option value="" selected disabled>Seleziona una lezione...</option>
                                    {foreach from=$lezioni_disponibili item=lez}
                                        <option value="{$lez.id}">
                                            {$lez.data|escape} &bull; {$lez.ora_inizio|escape} - {$lez.nome_corso|escape} ({$lez.istruttore|escape}) [{$lez.num_iscritti}/{$lez.capienza_max}]
                                        </option>
                                    {/foreach}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary admin-action-btn w-100">
                                Gestisci Lezione
                            </button>
                        </form>
                    {/if}
                </div>
            </section>
        </div>

    </div>
</div>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnChiudiAvviso = document.querySelector('.js-chiudi-avviso-password');
    if (btnChiudiAvviso) {
        btnChiudiAvviso.addEventListener('click', function () {
            fetch('index.php?controller=utente&action=chiudiAvvisoPassword', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).catch(function () {});
        });
    }
});
</script>
{/literal}
{/block}
