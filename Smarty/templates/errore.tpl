<!-- File: Smarty/templates/errore.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<section class="auth-section">
    <div class="auth-card text-center">

        <div class="error-state-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>

        <h1 class="auth-title">Operazione non completata</h1>

        <div class="auth-alert-error text-start my-4" role="alert">
            {$errore|escape}
        </div>

        <div class="d-flex flex-column gap-2">
            <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary auth-submit-btn w-100">
                Torna al Calendario
            </a>
            <a href="index.php?controller=utente&action=dashboard" class="auth-link mt-2">
                Vai alla tua Dashboard
            </a>
        </div>

    </div>
</section>
{/block}
