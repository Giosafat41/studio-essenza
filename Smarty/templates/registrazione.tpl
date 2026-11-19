<!-- File: Smarty/templates/registrazione.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<section class="auth-section">
    <div class="auth-card auth-card-wide">

        <!-- Intestazione -->
        <div class="text-center mb-4">
            <span class="auth-badge mb-3">Nuovo Allievo</span>
            <h1 class="auth-title">Crea il tuo account</h1>
            <p class="auth-subtitle">
                Registrati per prenotare le tue lezioni e gestire il tuo percorso in Studio Essenza.
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

        <!-- Form di registrazione -->
        <form action="index.php?controller=utente&action=registra" method="POST" class="auth-form">

            <!-- Nome e Cognome affiancati su desktop -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="nome" class="form-label auth-label">Nome</label>
                    <div class="auth-input-group">
                        <span class="auth-input-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control auth-input"
                            required
                            autocomplete="given-name"
                            autofocus
                            placeholder="Mario"
                        >
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <label for="cognome" class="form-label auth-label">Cognome</label>
                    <div class="auth-input-group">
                        <span class="auth-input-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                        <input
                            type="text"
                            id="cognome"
                            name="cognome"
                            class="form-control auth-input"
                            required
                            autocomplete="family-name"
                            placeholder="Rossi"
                        >
                    </div>
                </div>
            </div>

            <!-- Campo Telefono -->
            <div class="mb-3">
                <label for="telefono" class="form-label auth-label">
                    Telefono <span class="auth-optional">(opzionale)</span>
                </label>
                <div class="auth-input-group">
                    <span class="auth-input-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </span>
                    <input
                        type="tel"
                        id="telefono"
                        name="telefono"
                        class="form-control auth-input"
                        autocomplete="tel"
                        placeholder="+39 333 1234567"
                    >
                </div>
            </div>

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
                        autocomplete="new-password"
                        placeholder="Scegli una password"
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

            <!-- Pulsante Registrati -->
            <button type="submit" class="btn btn-primary auth-submit-btn w-100">
                Registrati
            </button>
        </form>

        <hr class="auth-divider my-4">

        <!-- Link Login -->
        <p class="auth-footer mb-3">
            Sei già iscritto?
            <a href="index.php?controller=utente&action=login" class="auth-link">Accedi qui</a>
        </p>

        <!-- Nota informativa studio -->
        <div class="auth-support-note">
            I pacchetti ingressi si attivano in segreteria.
            <a href="index.php?controller=info&action=tariffe">Scopri le tariffe</a> dello studio.
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
