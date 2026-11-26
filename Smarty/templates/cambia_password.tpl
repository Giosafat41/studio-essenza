<!-- File: Smarty/templates/cambia_password.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<section class="auth-section">
    <div class="auth-card auth-card-wide">

        <!-- Link ritorno alla Dashboard -->
        <div class="mb-3">
            <a href="{$url_ritorno|escape}" class="calendar-back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Torna alla Dashboard</span>
            </a>
        </div>

        <!-- Intestazione -->
        <div class="text-center mb-4">
            <span class="auth-badge mb-3">Sicurezza Account</span>
            <h1 class="auth-title">Cambia Password</h1>
            <p class="auth-subtitle">
                Scegli una nuova password personale per proteggere il tuo profilo Studio Essenza.
            </p>
        </div>

        {if !empty($avviso_attivo)}
            <div class="dashboard-avviso-rinnovo d-flex align-items-start gap-2 mb-4" role="status">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <div>
                    Il tuo profilo usa ancora la password iniziale impostata dalla segreteria. Una volta salvata la nuova password, l'avviso non comparirà più.
                </div>
            </div>
        {/if}

        <!-- Messaggio di errore -->
        {if isset($errore)}
            <div class="auth-alert-error d-flex align-items-start gap-2 mb-4" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{$errore|escape}</span>
            </div>
        {/if}

        <form action="index.php?controller=utente&action=cambiaPassword" method="POST" class="auth-form">

            <!-- Password Attuale -->
            <div class="mb-3">
                <label for="password_attuale" class="form-label auth-label">Password attuale</label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="password_attuale"
                        name="password_attuale"
                        class="form-control auth-input auth-input-password"
                        required
                        data-msg-required="Inserisci la tua password attuale."
                        autocomplete="current-password"
                        autofocus
                        placeholder="Inserisci la password attuale"
                    >
                    <button
                        type="button"
                        class="auth-toggle-password js-toggle-password"
                        data-target="password_attuale"
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
            </div>

            <!-- Nuova Password -->
            <div class="mb-3">
                <label for="nuova_password" class="form-label auth-label">Nuova password</label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="nuova_password"
                        name="nuova_password"
                        class="form-control auth-input auth-input-password"
                        required
                        minlength="6"
                        data-msg-required="Inserisci una nuova password."
                        data-msg-minlength="La nuova password deve contenere almeno 6 caratteri."
                        autocomplete="new-password"
                        placeholder="Almeno 6 caratteri"
                    >
                    <button
                        type="button"
                        class="auth-toggle-password js-toggle-password"
                        data-target="nuova_password"
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
            </div>

            <!-- Conferma Nuova Password -->
            <div class="mb-4">
                <label for="conferma_password" class="form-label auth-label">Conferma nuova password</label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="conferma_password"
                        name="conferma_password"
                        class="form-control auth-input auth-input-password"
                        required
                        minlength="6"
                        data-msg-required="Ripeti la nuova password per confermarla."
                        data-msg-minlength="La conferma della password deve contenere almeno 6 caratteri."
                        data-match-target="nuova_password"
                        data-msg-match="La nuova password e la conferma non coincidono."
                        autocomplete="new-password"
                        placeholder="Ripeti la nuova password"
                    >
                    <button
                        type="button"
                        class="auth-toggle-password js-toggle-password"
                        data-target="conferma_password"
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
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary auth-submit-btn flex-grow-1">
                    Salva Nuova Password
                </button>
                <a href="{$url_ritorno|escape}" class="btn btn-outline-essenza auth-submit-btn">
                    Annulla
                </a>
            </div>
        </form>

    </div>
</section>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-toggle-password').forEach(function (toggleBtn) {
        const targetId = toggleBtn.getAttribute('data-target');
        const passwordInput = targetId ? document.getElementById(targetId) : null;
        if (!passwordInput) return;

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
    });
});
</script>
{/literal}
{/block}
