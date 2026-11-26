<!-- File: Smarty/templates/admin_corsi.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno al Pannello Admin -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al Pannello Admin</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Amministrazione</span>
                <h1 class="dashboard-title">Gestione Corsi</h1>
                <p class="dashboard-subtitle">
                    Inserisci e aggiorna le tipologie di corsi di gruppo disponibili per la programmazione delle lezioni.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=admin&action=aggiungiLezione" class="btn btn-primary dashboard-cta-btn w-100">
                    + Programma Nuova Lezione
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

    <div class="row g-4 align-items-start">

        <!-- Form Inserimento / Modifica Corso -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card">
                <h2 class="dashboard-section-title mb-3">
                    {if isset($corso_in_modifica)}Modifica Corso{else}Nuovo Corso{/if}
                </h2>

                <form action="index.php?controller=admin&action=salvaCorso" method="POST">
                    {if isset($corso_in_modifica)}
                        <input type="hidden" name="id" value="{$corso_in_modifica->getId()}">
                    {/if}

                    <div class="mb-3">
                        <label for="nome" class="form-label auth-label">Nome del Corso</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control admin-input"
                            required
                            data-msg-required="Inserisci il nome del corso."
                            maxlength="100"
                            placeholder="Es. Pilates Reformer"
                            value="{if isset($corso_in_modifica)}{$corso_in_modifica->getNome()|escape}{/if}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="capienza_max" class="form-label auth-label">Capienza Massima (posti)</label>
                        <input
                            type="number"
                            id="capienza_max"
                            name="capienza_max"
                            class="form-control admin-input"
                            required
                            data-msg-required="Inserisci la capienza massima del corso."
                            data-msg-min="La capienza minima consentita è 1 posto."
                            data-msg-max="La capienza massima consentita è 100 posti."
                            min="1"
                            max="100"
                            value="{if isset($corso_in_modifica)}{$corso_in_modifica->getCapienzaMax()}{else}8{/if}"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="descrizione" class="form-label auth-label">Descrizione <span class="auth-optional">(opzionale)</span></label>
                        <textarea
                            id="descrizione"
                            name="descrizione"
                            class="form-control admin-input"
                            rows="3"
                            placeholder="Breve descrizione della disciplina..."
                        >{if isset($corso_in_modifica)}{$corso_in_modifica->getDescrizione()|escape}{/if}</textarea>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary admin-action-btn w-100">
                            {if isset($corso_in_modifica)}Salva Modifiche{else}Inserisci Corso{/if}
                        </button>
                        {if isset($corso_in_modifica)}
                            <a href="index.php?controller=admin&action=corsi" class="btn btn-outline-essenza admin-action-btn w-100">
                                Annulla Modifica
                            </a>
                        {/if}
                    </div>
                </form>
            </section>
        </div>

        <!-- Elenco Corsi Esistenti -->
        <div class="col-12 col-lg-8">
            <section class="dashboard-card">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                    <h2 class="dashboard-section-title">Elenco Corsi dello Studio</h2>
                    <span class="dashboard-count-badge">
                        {$corsi|@count} {if $corsi|@count == 1}corso{else}corsi{/if}
                    </span>
                </div>

                {if empty($corsi)}
                    <div class="dashboard-empty">
                        <p class="dashboard-empty-title">Nessun corso presente</p>
                        <p class="dashboard-empty-text">Usa il modulo a sinistra per inserire il primo corso di Studio Essenza.</p>
                    </div>
                {else}
                    <div class="table-responsive">
                        <table class="table admin-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Corso</th>
                                    <th>Capienza</th>
                                    <th>Lezioni</th>
                                    <th class="text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$corsi item=c}
                                    <tr>
                                        <td>
                                            <strong>{$c.nome|escape}</strong>
                                            {if !empty($c.descrizione)}
                                                <div class="text-muted small mt-1">{$c.descrizione|escape}</div>
                                            {/if}
                                        </td>
                                        <td>
                                            <span class="dashboard-count-badge">{$c.capienza_max} posti</span>
                                        </td>
                                        <td>{$c.num_lezioni}</td>
                                        <td class="text-end text-nowrap">
                                            <a href="index.php?controller=admin&action=corsi&edit={$c.id}" class="btn btn-sm btn-outline-essenza">
                                                Modifica
                                            </a>
                                            {if $c.num_lezioni == 0}
                                                <form action="index.php?controller=admin&action=eliminaCorso" method="POST" class="d-inline" onsubmit="return confirm('Vuoi davvero eliminare il corso {$c.nome|escape:'javascript'}?');">
                                                    <input type="hidden" name="id_corso" value="{$c.id}">
                                                    <button type="submit" class="btn btn-sm btn-disdici ms-1">Elimina</button>
                                                </form>
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

    </div>
</div>
{/block}
