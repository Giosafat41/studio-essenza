<!-- File: Smarty/templates/admin_lezione.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-form-page py-2 py-md-3">

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

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2">Gestione Palinsesto</span>
            <h1 class="dashboard-title">Programma Nuova Lezione</h1>
            <p class="dashboard-subtitle">
                Inserisci una nuova classe di gruppo nel calendario settimanale di Studio Essenza.
            </p>
        </div>

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

        <form action="index.php?controller=admin&action=aggiungiLezione" method="POST">
            <div class="mb-3">
                <label for="id_corso" class="form-label auth-label">Tipo di Corso</label>
                <select id="id_corso" name="id_corso" class="form-select admin-select" required>
                    {foreach from=$corsi item=corso}
                        <option value="{$corso->getId()}">{$corso->getNome()|escape} (Max {$corso->getCapienzaMax()} posti)</option>
                    {/foreach}
                </select>
            </div>

            <div class="mb-3">
                <label for="id_istruttore" class="form-label auth-label">Istruttore</label>
                <select id="id_istruttore" name="id_istruttore" class="form-select admin-select" required>
                    {foreach from=$istruttori item=istr}
                        <option value="{$istr->getId()}">{$istr->getNome()|escape} {$istr->getCognome()|escape}</option>
                    {/foreach}
                </select>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6">
                    <label for="data_ora_inizio" class="form-label auth-label">Data e Ora di Inizio</label>
                    <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" class="form-control admin-input" required>
                </div>

                <div class="col-12 col-sm-6">
                    <label for="data_ora_fine" class="form-label auth-label">Data e Ora di Fine</label>
                    <input type="datetime-local" id="data_ora_fine" name="data_ora_fine" class="form-control admin-input" required>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary admin-action-btn px-4">
                    Salva a Calendario
                </button>
                <a href="index.php?controller=admin&action=dashboard" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>
{/block}
