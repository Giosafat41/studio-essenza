<!-- File: Smarty/templates/admin_utente_form.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-form-page py-2 py-md-3">

    <!-- Link ritorno alla Lista Utenti -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=utenti" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna alla Lista Utenti</span>
        </a>
    </div>

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2">Anagrafica Studio</span>
            {if isset($utente)}
                <h1 class="dashboard-title">Modifica Utente</h1>
                <p class="dashboard-subtitle">
                    Aggiorna i dati anagrafici, i crediti residui o la scadenza del certificato medico di <strong>{$utente->getNome()|escape} {$utente->getCognome()|escape}</strong>.
                </p>
            {else}
                <h1 class="dashboard-title">Crea Nuovo Utente</h1>
                <p class="dashboard-subtitle">
                    Registra un nuovo allievo, istruttore o amministratore nel sistema di Studio Essenza.
                </p>
            {/if}
        </div>

        {if isset($messaggio_errore)}
            <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
                <span>{$messaggio_errore|escape}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        {/if}

        <form action="index.php?controller=admin&action={if isset($utente)}modificaUtente{else}creaUtente{/if}" method="POST" enctype="multipart/form-data">

            {if isset($utente)}
                <input type="hidden" name="id" value="{$utente->getId()}">
            {/if}

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="nome" class="form-label auth-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control admin-input" required value="{if isset($utente)}{$utente->getNome()|escape}{/if}">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="cognome" class="form-label auth-label">Cognome</label>
                    <input type="text" id="cognome" name="cognome" class="form-control admin-input" required value="{if isset($utente)}{$utente->getCognome()|escape}{/if}">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="email" class="form-label auth-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control admin-input" required value="{if isset($utente)}{$utente->getEmail()|escape}{/if}">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="telefono" class="form-label auth-label">Telefono <span class="auth-optional">(opzionale)</span></label>
                    <input type="tel" id="telefono" name="telefono" class="form-control admin-input" value="{if isset($utente)}{$utente->getTelefono()|escape}{/if}">
                </div>
            </div>

            {if !isset($utente)}
                <div class="mb-3">
                    <label for="password" class="form-label auth-label">Password Iniziale</label>
                    <input type="password" id="password" name="password" class="form-control admin-input" required placeholder="Imposta una password per l'utente">
                </div>
            {/if}

            <div class="mb-3">
                <label for="ruolo" class="form-label auth-label">Ruolo nel Sistema</label>
                <select id="ruolo" name="ruolo" class="form-select admin-select" required>
                    <option value="allievo" {if !isset($utente) || $utente->getRuolo() == 'allievo'}selected{/if}>Allievo</option>
                    <option value="istruttore" {if isset($utente) && $utente->getRuolo() == 'istruttore'}selected{/if}>Istruttore</option>
                    <option value="admin" {if isset($utente) && $utente->getRuolo() == 'admin'}selected{/if}>Admin (Segreteria)</option>
                </select>
            </div>

            {assign var="mostra_campi_allievo" value=(!isset($utente) || $utente->getRuolo() == 'allievo')}
            {assign var="mostra_campo_istruttore" value=(isset($utente) && $utente->getRuolo() == 'istruttore')}
            <div id="campi-allievo" class="row g-3 mb-4{if !$mostra_campi_allievo} d-none{/if}">
                <div class="col-12 col-sm-6">
                    <label for="crediti_residui" class="form-label auth-label">Crediti Residui</label>
                    <input
                        type="number"
                        id="crediti_residui"
                        name="crediti_residui"
                        class="form-control admin-input"
                        min="0"
                        value="{if isset($utente)}{$utente->getCreditiResidui()}{else}0{/if}"
                        {if $mostra_campi_allievo}required{else}disabled{/if}
                    >
                </div>

                <div class="col-12 col-sm-6">
                    <label for="scadenza_certificato" class="form-label auth-label">Scadenza Certificato Medico <span class="auth-optional">(opzionale)</span></label>
                    <input
                        type="date"
                        id="scadenza_certificato"
                        name="scadenza_certificato"
                        class="form-control admin-input"
                        value="{if isset($utente)}{$utente->getScadenzaCertificato()|escape}{/if}"
                        {if !$mostra_campi_allievo}disabled{/if}
                    >
                    <div class="form-text mt-1">Lascia vuoto se non ancora consegnato.</div>
                </div>
            </div>

            <div id="campo-istruttore" class="mb-4{if !$mostra_campo_istruttore} d-none{/if}">
                <div class="mb-3">
                    <label for="immagine_profilo" class="form-label auth-label">Immagine Profilo Istruttore <span class="auth-optional">(opzionale)</span></label>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="admin-avatar-preview" id="admin-avatar-preview">
                            {if isset($utente) && $utente->getImmagineProfilo()}
                                <img src="/studio-essenza/{$utente->getImmagineProfilo()|escape}" alt="Immagine profilo">
                            {else}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            {/if}
                        </div>
                        <div class="flex-grow-1">
                            <input
                                type="file"
                                id="immagine_profilo"
                                name="immagine_profilo"
                                class="form-control admin-input"
                                accept="image/jpeg,image/png,image/webp,image/gif"
                                {if !$mostra_campo_istruttore}disabled{/if}
                            >
                            <div class="form-text mt-1">Formati consentiti: JPG, PNG, WEBP, GIF (max 5 MB).</div>
                            {if isset($utente) && $utente->getImmagineProfilo()}
                                <div class="form-check mt-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        value="1"
                                        id="rimuovi_immagine"
                                        name="rimuovi_immagine"
                                        {if !$mostra_campo_istruttore}disabled{/if}
                                    >
                                    <label class="form-check-label small text-danger" for="rimuovi_immagine">
                                        Rimuovi immagine profilo attuale
                                    </label>
                                </div>
                            {/if}
                        </div>
                    </div>
                </div>

                <div>
                    <label for="descrizione" class="form-label auth-label">Descrizione Istruttore <span class="auth-optional">(visibile nella Home)</span></label>
                    <textarea
                        id="descrizione"
                        name="descrizione"
                        class="form-control admin-input"
                        rows="3"
                        maxlength="300"
                        placeholder="Es. Specialista in Pilates Reformer, Matwork e percorsi posturali personalizzati..."
                        {if !$mostra_campo_istruttore}disabled{/if}
                    >{if isset($utente)}{$utente->getDescrizione()|escape}{/if}</textarea>
                    <div class="form-text mt-1">Breve presentazione che comparirà nel carosello degli istruttori in homepage (max 300 caratteri).</div>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary admin-action-btn px-4">
                    {if isset($utente)}Salva Modifiche{else}Crea Utente{/if}
                </button>
                <a href="index.php?controller=admin&action=utenti" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ruoloSelect = document.getElementById('ruolo');
    const campiAllievo = document.getElementById('campi-allievo');
    const campoIstruttore = document.getElementById('campo-istruttore');
    const creditiInput = document.getElementById('crediti_residui');
    const certificatoInput = document.getElementById('scadenza_certificato');
    const descrizioneInput = document.getElementById('descrizione');
    const immagineInput = document.getElementById('immagine_profilo');
    const rimuoviImgCheckbox = document.getElementById('rimuovi_immagine');
    const avatarPreview = document.getElementById('admin-avatar-preview');

    if (!ruoloSelect || !campiAllievo || !campoIstruttore || !creditiInput || !certificatoInput || !descrizioneInput || !immagineInput) return;

    function aggiornaCampiRuolo() {
        const isAllievo = ruoloSelect.value === 'allievo';
        const isIstruttore = ruoloSelect.value === 'istruttore';

        campiAllievo.classList.toggle('d-none', !isAllievo);
        creditiInput.disabled = !isAllievo;
        creditiInput.required = isAllievo;
        certificatoInput.disabled = !isAllievo;

        campoIstruttore.classList.toggle('d-none', !isIstruttore);
        descrizioneInput.disabled = !isIstruttore;
        immagineInput.disabled = !isIstruttore;
        if (rimuoviImgCheckbox) {
            rimuoviImgCheckbox.disabled = !isIstruttore;
        }

        if (isAllievo && creditiInput.value === '') {
            creditiInput.value = '0';
        }
    }

    immagineInput.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file || !avatarPreview) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Anteprima profilo">';
        };
        reader.readAsDataURL(file);
        if (rimuoviImgCheckbox) {
            rimuoviImgCheckbox.checked = false;
        }
    });

    ruoloSelect.addEventListener('change', aggiornaCampiRuolo);
    aggiornaCampiRuolo();
});
</script>
{/literal}
{/block}
