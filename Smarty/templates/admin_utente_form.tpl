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

        <form action="index.php?controller=admin&action={if isset($utente)}modificaUtente{else}creaUtente{/if}" method="POST">

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

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="ruolo" class="form-label auth-label">Ruolo nel Sistema</label>
                    <select id="ruolo" name="ruolo" class="form-select admin-select" required>
                        <option value="allievo" {if isset($utente) && $utente->getRuolo() == 'allievo'}selected{/if}>Allievo</option>
                        <option value="istruttore" {if isset($utente) && $utente->getRuolo() == 'istruttore'}selected{/if}>Istruttore</option>
                        <option value="admin" {if isset($utente) && $utente->getRuolo() == 'admin'}selected{/if}>Admin (Segreteria)</option>
                    </select>
                </div>

                <div class="col-12 col-sm-6">
                    <label for="crediti_residui" class="form-label auth-label">Crediti Residui</label>
                    <input type="number" id="crediti_residui" name="crediti_residui" class="form-control admin-input" min="0" required value="{if isset($utente)}{$utente->getCreditiResidui()}{else}0{/if}">
                </div>
            </div>

            <div class="mb-4">
                <label for="scadenza_certificato" class="form-label auth-label">Scadenza Certificato Medico <span class="auth-optional">(opzionale)</span></label>
                <input type="date" id="scadenza_certificato" name="scadenza_certificato" class="form-control admin-input" value="{if isset($utente)}{$utente->getScadenzaCertificato()|escape}{/if}">
                <div class="form-text mt-1">Lascia vuoto se il certificato non è ancora stato consegnato.</div>
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
{/block}
