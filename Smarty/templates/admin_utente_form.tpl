<!-- File: Smarty/templates/admin_utente_form.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-form-page py-2 py-md-3">

    <!-- Link ritorno alla Lista -->
    <div class="mb-3">
        <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=utenti" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna alla {$label_lista|default:'Lista Utenti'|escape}</span>
        </a>
    </div>

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2">{$badge_sezione|default:'Anagrafica Studio'|escape}</span>
            {if isset($utente)}
                <h1 class="dashboard-title">Modifica Profilo</h1>
                <p class="dashboard-subtitle">
                    Aggiorna i dati del profilo di <strong>{$utente->getNome()|escape} {$utente->getCognome()|escape}</strong>.
                </p>
            {else}
                <h1 class="dashboard-title">Crea Nuovo Profilo</h1>
                <p class="dashboard-subtitle">
                    {if ($controller_base|default:'admin') == 'admin'}
                        Registra un nuovo segretario o istruttore nel sistema di Studio Essenza.
                    {else}
                        Registra un nuovo allievo o istruttore nel sistema di Studio Essenza.
                    {/if}
                </p>
            {/if}
        </div>

        {if isset($messaggio_errore)}
            <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
                <span>{$messaggio_errore|escape}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        {/if}

        <form action="index.php?controller={$controller_base|default:'admin'|escape}&action={if isset($utente)}modificaUtente{else}creaUtente{/if}" method="POST" enctype="multipart/form-data">

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
                    <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch">
                        <div class="auth-input-group flex-grow-1">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control admin-input auth-input-password admin-input-readonly"
                                required
                                readonly
                                autocomplete="new-password"
                                placeholder="nome.cognome"
                            >
                            <button
                                type="button"
                                class="auth-toggle-password"
                                id="togglePassword"
                                aria-label="Mostra password"
                                aria-pressed="false"
                                title="Mostra o nascondi password"
                            >
                                <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="icon-eye-off d-none" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                    <line x1="2" y1="2" x2="22" y2="22"></line>
                                </svg>
                            </button>
                        </div>
                        <button
                            type="button"
                            id="btnModificaPassword"
                            class="btn btn-outline-essenza admin-action-btn text-nowrap px-3"
                        >
                            Modifica
                        </button>
                    </div>
                    <div class="form-text mt-1" id="passwordHelperText">
                        Generata automaticamente come <strong>nome.cognome</strong>. Clicca su "Modifica" per personalizzarla.
                    </div>
                </div>
            {/if}

            <div class="mb-3">
                <label for="ruolo" class="form-label auth-label">Ruolo nel Sistema</label>
                {assign var="ruolo_corrente" value=$ruolo_default|default:'allievo'}
                {if isset($utente)}
                    {assign var="ruolo_corrente" value=$utente->getRuolo()}
                {/if}
                <select id="ruolo" name="ruolo" class="form-select admin-select" required>
                    {foreach from=$ruoli_consentiti key=val item=label}
                        <option value="{$val|escape}" {if $ruolo_corrente == $val}selected{/if}>{$label|escape}</option>
                    {/foreach}
                </select>
            </div>

            {assign var="mostra_campi_allievo" value=($ruolo_corrente == 'allievo')}
            {assign var="mostra_campo_istruttore" value=($ruolo_corrente == 'istruttore')}
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

                <div class="mb-3">
                    <label for="tariffa_individuale" class="form-label auth-label">Tariffa Lezione Individuale (&euro;/ora) <span class="auth-optional">(opzionale)</span></label>
                    <input
                        type="number"
                        id="tariffa_individuale"
                        name="tariffa_individuale"
                        class="form-control admin-input"
                        min="1"
                        max="9999.99"
                        step="0.50"
                        placeholder="Es. 45"
                        value="{if isset($utente) && $utente->getTariffaIndividuale() !== null}{$utente->getTariffaIndividuale()}{/if}"
                        {if !$mostra_campo_istruttore}disabled{/if}
                    >
                    <div class="form-text mt-1">L'istruttore potrà modificarla in autonomia dalla propria dashboard.</div>
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
                    {if isset($utente)}Salva Modifiche{else}Crea Profilo{/if}
                </button>
                <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=utenti" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const btnModificaPassword = document.getElementById('btnModificaPassword');
    const passwordHelperText = document.getElementById('passwordHelperText');
    const nomeInput = document.getElementById('nome');
    const cognomeInput = document.getElementById('cognome');

    if (toggleBtn && passwordInput) {
        const eyeIcon = toggleBtn.querySelector('.icon-eye');
        const eyeOffIcon = toggleBtn.querySelector('.icon-eye-off');

        toggleBtn.addEventListener('click', function () {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';

            eyeIcon.classList.toggle('d-none', isHidden);
            eyeOffIcon.classList.toggle('d-none', !isHidden);

            toggleBtn.setAttribute('aria-pressed', String(isHidden));
            toggleBtn.setAttribute('aria-label', isHidden ? 'Nascondi password' : 'Mostra password');
        });
    }

    if (passwordInput && btnModificaPassword && nomeInput && cognomeInput) {
        let modificaManuale = false;

        function pulisciPartePassword(valore) {
            return (valore || '')
                .trim()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9]/g, '');
        }

        function aggiornaPasswordAutomatica() {
            if (modificaManuale) return;
            const parteNome = pulisciPartePassword(nomeInput.value);
            const parteCognome = pulisciPartePassword(cognomeInput.value);
            if (parteNome && parteCognome) {
                passwordInput.value = parteNome + '.' + parteCognome;
            } else if (parteNome) {
                passwordInput.value = parteNome + '.';
            } else if (parteCognome) {
                passwordInput.value = '.' + parteCognome;
            } else {
                passwordInput.value = '';
            }
        }

        nomeInput.addEventListener('input', aggiornaPasswordAutomatica);
        cognomeInput.addEventListener('input', aggiornaPasswordAutomatica);

        btnModificaPassword.addEventListener('click', function () {
            modificaManuale = !modificaManuale;
            passwordInput.readOnly = !modificaManuale;
            passwordInput.classList.toggle('admin-input-readonly', !modificaManuale);

            if (modificaManuale) {
                btnModificaPassword.textContent = 'Ripristina';
                btnModificaPassword.title = 'Torna alla password automatica nome.cognome';
                if (passwordHelperText) {
                    passwordHelperText.innerHTML = 'Modalità modifica attiva. Clicca su "Ripristina" per tornare a <strong>nome.cognome</strong>.';
                }
                passwordInput.focus();
                passwordInput.select();
            } else {
                btnModificaPassword.textContent = 'Modifica';
                btnModificaPassword.title = 'Personalizza la password iniziale';
                if (passwordHelperText) {
                    passwordHelperText.innerHTML = 'Generata automaticamente come <strong>nome.cognome</strong>. Clicca su "Modifica" per personalizzarla.';
                }
                aggiornaPasswordAutomatica();
            }
        });

        aggiornaPasswordAutomatica();
    }

    const ruoloSelect = document.getElementById('ruolo');
    const campiAllievo = document.getElementById('campi-allievo');
    const campoIstruttore = document.getElementById('campo-istruttore');
    const creditiInput = document.getElementById('crediti_residui');
    const certificatoInput = document.getElementById('scadenza_certificato');
    const descrizioneInput = document.getElementById('descrizione');
    const tariffaInput = document.getElementById('tariffa_individuale');
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
        if (tariffaInput) {
            tariffaInput.disabled = !isIstruttore;
        }
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
