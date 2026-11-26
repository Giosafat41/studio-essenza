<!-- File: Smarty/templates/admin_dashboard.tpl -->
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
                    Benvenuto/a, <strong>{$nome_admin|escape}</strong>. Gestisci anagrafica iscritti, palinsesto corsi e registro presenze di Studio Essenza.
                </p>
            </div>

            <div class="calendar-status-group">
                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Utenti registrati</span>
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
        </div>
    </section>

    <!-- Eventuale messaggio di errore -->
    {if isset($messaggio_errore)}
        <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span>{$messaggio_errore|escape}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}

    <!-- Griglia Strumenti di Segreteria -->
    <div class="row g-4 align-items-stretch">

        <!-- Card 1: Gestione Utenti -->
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

                <h2 class="admin-card-title">Gestione Utenti</h2>
                <p class="admin-card-desc">
                    Visualizza tutti gli iscritti, aggiorna anagrafica, crediti residui e certificati medici oppure registra nuovi profili.
                </p>

                <div class="mt-auto pt-3 d-flex flex-column gap-2">
                    <a href="index.php?controller=admin&action=utenti" class="btn btn-primary admin-action-btn w-100">
                        Lista Utenti
                    </a>
                    <a href="index.php?controller=admin&action=creaUtente" class="btn btn-outline-essenza admin-action-btn w-100">
                        + Nuovo Utente
                    </a>
                </div>
            </section>
        </div>

        <!-- Card 2: Gestione Palinsesto -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card admin-action-card h-100 d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="admin-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <line x1="12" y1="14" x2="12" y2="18"></line>
                            <line x1="10" y1="16" x2="14" y2="16"></line>
                        </svg>
                    </div>
                    <span class="dashboard-count-badge">Calendario</span>
                </div>

                <h2 class="admin-card-title">Gestione Palinsesto</h2>
                <p class="admin-card-desc">
                    Inserisci nuove lezioni di gruppo a calendario scegliendo tipologia di corso, fascia oraria e istruttore assegnato.
                </p>

                <div class="mt-auto pt-3">
                    <a href="index.php?controller=admin&action=aggiungiLezione" class="btn btn-primary admin-action-btn w-100">
                        Nuova Lezione
                    </a>
                </div>
            </section>
        </div>

        <!-- Card 3: Registro Appello con Menù a Tendina Lezioni Disponibili -->
        <div class="col-12 col-lg-4">
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
                        {$lezioni_disponibili|@count} {if $lezioni_disponibili|@count == 1}disponibile{else}disponibili{/if}
                    </span>
                </div>

                <h2 class="admin-card-title">Registro Appello</h2>
                <p class="admin-card-desc">
                    Scegli una lezione in programma dal menù a tendina per consultare subito l'elenco degli allievi prenotati.
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
                                <label for="id_lezione" class="form-label auth-label">Lezione disponibile</label>
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
                                Apri Appello
                            </button>
                        </form>
                    {/if}
                </div>
            </section>
        </div>

    </div>
</div>
{/block}
