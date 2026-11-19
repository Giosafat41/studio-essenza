<!-- File: Smarty/templates/login.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<section class="auth-section">
    <div class="auth-card">

        <!-- Intestazione -->
        <div class="text-center mb-4">
            <span class="auth-badge mb-3">Area Riservata</span>
            <h1 class="auth-title">Accedi al tuo profilo</h1>
            <p class="auth-subtitle">
                Inserisci le tue credenziali per gestire lezioni e prenotazioni in Studio Essenza.
            </p>
        </div>

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

        <!-- Form di accesso -->
        <form action="index.php?controller=utente&action=login" method="POST" class="auth-form">

            <!-- Campo Email -->
            <div class="mb-3">
                <label for="email" class="form-label auth-label">Email</label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                    </span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control auth-input"
                        required
                        autocomplete="email"
                        autofocus
                        placeholder="nome@esempio.it"
                    >
                </div>
            </div>

            <!-- Campo Password -->
            <div class="mb-4">
                <label for="password" class="form-label auth-label">Password</label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control auth-input auth-input-password"
                        required
                        autocomplete="current-password"
                        placeholder="Inserisci la tua password"
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
            </div>

            <!-- Pulsante Accedi -->
            <button type="submit" class="btn btn-primary auth-submit-btn w-100">
                Accedi
            </button>
        </form>

        <hr class="auth-divider my-4">

        <!-- Link Registrazione -->
        <p class="auth-footer mb-3">
            Non hai ancora un account?
            <a href="index.php?controller=utente&action=registra" class="auth-link">Registrati qui</a>
        </p>

        <!-- Nota recupero credenziali -->
        <div class="auth-support-note">
            Hai dimenticato la password?
            <a href="index.php?controller=info&action=contatti">Contatta la segreteria</a> dello studio per assistenza.
        </div>

    </div>
</section>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (!toggleBtn || !passwordInput) return;

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
</script>
{/literal}
{/block}
