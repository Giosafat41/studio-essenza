<!-- File: Smarty/templates/admin_lezione.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-form-page py-2 py-md-3">

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

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="data_ora_inizio" class="form-label auth-label">Data e Ora di Inizio</label>
                    <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" class="form-control admin-input" required>
                </div>

                <div class="col-12 col-sm-6">
                    <label for="durata_minuti" class="form-label auth-label">Durata</label>
                    <select id="durata_minuti" name="durata_minuti" class="form-select admin-select" required>
                        <option value="30">30 minuti</option>
                        <option value="60" selected>1 ora (60 min)</option>
                        <option value="90">1 ora e 30 min (90 min)</option>
                        <option value="120">2 ore (120 min)</option>
                        <option value="150">2 ore e 30 min (150 min)</option>
                        <option value="180">3 ore (180 min)</option>
                    </select>
                </div>
            </div>

            <div id="anteprima-fine-lezione" class="auth-support-note text-start mb-4 d-none"></div>

            <div class="auth-support-note text-start mb-4">
                Eventuali slot di disponibilità individuale liberi dell'istruttore sovrapposti a questo orario verranno rimossi automaticamente.
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

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inizioInput = document.getElementById('data_ora_inizio');
    const durataSelect = document.getElementById('durata_minuti');
    const anteprima = document.getElementById('anteprima-fine-lezione');

    if (!inizioInput || !durataSelect || !anteprima) return;

    function aggiornaAnteprima() {
        if (!inizioInput.value) {
            anteprima.classList.add('d-none');
            return;
        }
        const inizio = new Date(inizioInput.value);
        const minuti = parseInt(durataSelect.value, 10) || 60;
        if (isNaN(inizio.getTime())) {
            anteprima.classList.add('d-none');
            return;
        }
        const fine = new Date(inizio.getTime() + minuti * 60000);
        const pad = function (n) { return String(n).padStart(2, '0'); };
        const dataFine = pad(fine.getDate()) + '/' + pad(fine.getMonth() + 1) + '/' + fine.getFullYear();
        const oraFine = pad(fine.getHours()) + ':' + pad(fine.getMinutes());
        anteprima.innerHTML = 'Termine previsto: <strong>' + dataFine + ' alle ' + oraFine + '</strong>';
        anteprima.classList.remove('d-none');
    }

    inizioInput.addEventListener('input', aggiornaAnteprima);
    inizioInput.addEventListener('change', aggiornaAnteprima);
    durataSelect.addEventListener('change', aggiornaAnteprima);
});
</script>
{/literal}
{/block}
