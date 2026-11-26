<!-- File: Smarty/templates/admin_dashboard.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container dashboard-page py-2 py-md-3">

    <!-- Intestazione Hero Admin -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Amministrazione</span>
                <h1 class="dashboard-title">Pannello Admin</h1>
                <p class="dashboard-subtitle">
                    Benvenuto/a, <strong>{$nome_admin|escape}</strong>. Gestisci segretari e istruttori, corsi dello studio e palinsesto lezioni.
                </p>
            </div>

            <div class="calendar-status-group">
                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Staff studio</span>
                    <div class="calendar-crediti-valore">
                        {$totale_staff}
                        <small>{if $totale_staff == 1}profilo{else}profili{/if}</small>
                    </div>
                </div>

                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Corsi attivi</span>
                    <div class="calendar-crediti-valore">
                        {$totale_corsi}
                        <small>{if $totale_corsi == 1}corso{else}corsi{/if}</small>
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
        </div>
    </section>

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

    <!-- Griglia Strumenti Admin -->
    <div class="row g-4 align-items-stretch">

        <!-- Card 1: Gestione Staff (Segretari e Istruttori) -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="admin-card-icon mb-3" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>

                <h2 class="admin-card-title">Segretari e Istruttori</h2>
                <p class="admin-card-desc">
                    Crea e gestisci i profili dei segretari e degli istruttori dello studio, incluse bio, foto e tariffe 1-to-1.
                </p>

                <div class="mt-auto pt-3 d-flex flex-column gap-2">
                    <a href="index.php?controller=admin&action=utenti" class="btn btn-primary admin-action-btn w-100">
                        Lista Staff
                    </a>
                    <a href="index.php?controller=admin&action=creaUtente" class="btn btn-outline-essenza admin-action-btn w-100">
                        + Nuovo Segretario / Istruttore
                    </a>
                </div>
            </section>
        </div>

        <!-- Card 2: Gestione Corsi -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="admin-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <span class="dashboard-count-badge">
                        {$totale_corsi} {if $totale_corsi == 1}corso{else}corsi{/if}
                    </span>
                </div>

                <h2 class="admin-card-title">Gestione Corsi</h2>
                <p class="admin-card-desc">
                    Inserisci nuove discipline e corsi di gruppo definendo nome, descrizione e capienza massima in sala.
                </p>

                <div class="mt-auto pt-3 d-flex flex-column gap-2">
                    <a href="index.php?controller=admin&action=corsi" class="btn btn-primary admin-action-btn w-100">
                        Gestisci Corsi
                    </a>
                    <a href="index.php?controller=admin&action=aggiungiLezione" class="btn btn-outline-essenza admin-action-btn w-100">
                        + Nuova Lezione a Calendario
                    </a>
                </div>
            </section>
        </div>

        <!-- Card 3: Gestione Lezioni Esistenti -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="admin-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <path d="m9 16 2 2 4-4"></path>
                        </svg>
                    </div>
                    <span class="dashboard-count-badge">
                        {$lezioni_disponibili|@count} {if $lezioni_disponibili|@count == 1}attiva{else}attive{/if}
                    </span>
                </div>

                <h2 class="admin-card-title">Gestione Lezioni</h2>
                <p class="admin-card-desc">
                    Seleziona una lezione in programma per visualizzare gli iscritti, disiscrivere allievi, cambiare istruttore o eliminarla.
                </p>

                <div class="mt-auto pt-3">
                    {if empty($lezioni_disponibili)}
                        <div class="admin-empty-inline">
                            <p class="mb-2">Nessuna lezione attiva in programma al momento.</p>
                            <a href="index.php?controller=admin&action=aggiungiLezione" class="auth-link">
                                Programma una nuova lezione &rarr;
                            </a>
                        </div>
                    {else}
                        <form action="index.php" method="GET" class="admin-appello-form">
                            <input type="hidden" name="controller" value="admin">
                            <input type="hidden" name="action" value="appello">

                            <div class="mb-3">
                                <label for="id_lezione" class="form-label auth-label">Lezione in programma</label>
                                <select id="id_lezione" name="id_lezione" class="form-select admin-select" required>
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
{/block}
