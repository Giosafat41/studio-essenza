<!-- File: Smarty/templates/admin_utenti.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno alla Dashboard -->
    <div class="mb-3">
        <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al {$label_dashboard|default:'Pannello'|escape}</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">{$badge_sezione|default:'Anagrafica Studio'|escape}</span>
                <h1 class="dashboard-title">{$titolo_sezione|default:'Gestione Utenti'|escape}</h1>
                <p class="dashboard-subtitle">
                    {$sottotitolo_sezione|default:'Visualizza e aggiorna i profili registrati.'|escape}
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=creaUtente" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span>{$label_nuovo|default:'Nuovo Utente'|escape}</span>
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

    <!-- Tabella Utenti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Profili</h2>
            <span class="dashboard-count-badge">
                {$utenti|@count} {if $utenti|@count == 1}profilo{else}profili{/if}
            </span>
        </div>

        {if empty($utenti)}
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun profilo presente</p>
                <p class="dashboard-empty-text">Non risultano ancora profili registrati in questa sezione.</p>
            </div>
        {else}
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Data di nascita</th>
                            <th>Ruolo</th>
                            {if !empty($mostra_colonne_allievo)}
                                <th>Crediti</th>
                                <th>Scadenza Certificato</th>
                            {else}
                                <th>Tariffa 1-to-1</th>
                            {/if}
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$utenti item=u}
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="admin-avatar-sm">
                                            {if $u->getImmagineProfilo()}
                                                <img src="/studio-essenza/{$u->getImmagineProfilo()|escape}" alt="{$u->getNome()|escape} {$u->getCognome()|escape}">
                                            {else}
                                                {$u->getNome()|substr:0:1|upper}{$u->getCognome()|substr:0:1|upper}
                                            {/if}
                                        </span>
                                        <strong>{$u->getCognome()|escape} {$u->getNome()|escape}</strong>
                                    </div>
                                </td>
                                <td>{$u->getEmail()|escape}</td>
                                <td>{$u->getTelefono()|default:'-'|escape}</td>
                                <td>{$u->getDataNascitaFormattata()|default:'-'|escape}</td>
                                <td>
                                    <span class="admin-role-pill is-{$u->getRuolo()|escape}">
                                        {$u->getRuolo()|escape}
                                    </span>
                                </td>
                                {if !empty($mostra_colonne_allievo)}
                                    <td>
                                        {if $u->getRuolo() == 'allievo'}
                                            <strong>{$u->getCreditiResidui()}</strong>
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                    <td>
                                        {if $u->getRuolo() == 'allievo'}
                                            {if $u->getScadenzaCertificato()}
                                                {if $u->haCertificatoValido()}
                                                    <span class="dashboard-status-pill is-confirmed">
                                                        {$u->getScadenzaCertificatoFormattata()|escape}
                                                    </span>
                                                {else}
                                                    <span class="dashboard-status-pill is-cancelled">
                                                        Scaduto ({$u->getScadenzaCertificatoFormattata()|escape})
                                                    </span>
                                                {/if}
                                            {else}
                                                <span class="text-muted small">Non presente</span>
                                            {/if}
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                {else}
                                    <td>
                                        {if $u->getRuolo() == 'istruttore'}
                                            {if $u->getTariffaFormattata()}
                                                <strong>{$u->getTariffaFormattata()|escape}</strong>
                                            {else}
                                                <span class="text-muted small">Su richiesta</span>
                                            {/if}
                                        {else}
                                            <span class="text-muted small">&mdash;</span>
                                        {/if}
                                    </td>
                                {/if}
                                <td class="text-end text-nowrap">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-essenza me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDettaglioUtente"
                                        data-nome="{$u->getNome()|escape}"
                                        data-cognome="{$u->getCognome()|escape}"
                                        data-iniziali="{$u->getNome()|substr:0:1|upper}{$u->getCognome()|substr:0:1|upper}"
                                        data-email="{$u->getEmail()|escape}"
                                        data-telefono="{$u->getTelefono()|default:''|escape}"
                                        data-nascita="{$u->getDataNascitaFormattata()|default:''|escape}"
                                        data-registrazione="{$u->getDataRegistrazioneFormattata()|default:''|escape}"
                                        data-ruolo="{$u->getRuolo()|escape}"
                                        data-crediti="{$u->getCreditiResidui()}"
                                        data-certificato="{$u->getScadenzaCertificatoFormattata()|default:''|escape}"
                                        data-certificato-valido="{if $u->haCertificatoValido()}1{else}0{/if}"
                                        data-tariffa="{$u->getTariffaFormattata()|default:''|escape}"
                                        data-descrizione="{$u->getDescrizione()|default:''|escape}"
                                        data-immagine="{$u->getImmagineProfilo()|default:''|escape}"
                                    >
                                        Dettagli
                                    </button>
                                    <a href="index.php?controller={$controller_base|default:'admin'|escape}&action=modificaUtente&id={$u->getId()}" class="btn btn-sm btn-primary">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
    </section>

</div>

<!-- MODALE DETTAGLI PROFILO UTENTE -->
<div class="modal fade" id="modalDettaglioUtente" tabindex="-1" aria-labelledby="modalDettaglioUtenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="modalDettaglioUtenteLabel" style="color: #4a4a4a;">Dettagli Profilo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                    <div class="profile-avatar" id="detUtenteAvatar"></div>
                    <div>
                        <h3 class="h5 fw-bold mb-1" id="detUtenteNome" style="color: #4a4a4a;"></h3>
                        <span class="admin-role-pill" id="detUtenteRuolo"></span>
                    </div>
                </div>

                <div class="row g-2 small">
                    <div class="col-12"><strong>Email:</strong> <span id="detUtenteEmail"></span></div>
                    <div class="col-12"><strong>Telefono:</strong> <span id="detUtenteTelefono"></span></div>
                    <div class="col-12"><strong>Data di nascita:</strong> <span id="detUtenteNascita"></span></div>
                    <div class="col-12"><strong>Registrato il:</strong> <span id="detUtenteRegistrazione"></span></div>

                    <div class="col-12 d-none pt-2 mt-2 border-top" id="detUtenteExtraAllievo">
                        <div class="mb-1"><strong>Crediti residui:</strong> <span id="detUtenteCrediti"></span></div>
                        <div><strong>Certificato medico:</strong> <span id="detUtenteCertificato"></span></div>
                    </div>

                    <div class="col-12 d-none pt-2 mt-2 border-top" id="detUtenteExtraIstruttore">
                        <div class="mb-1"><strong>Tariffa 1-to-1:</strong> <span id="detUtenteTariffa"></span></div>
                        <div><strong>Descrizione:</strong> <span id="detUtenteDescrizione"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-essenza" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('modalDettaglioUtente');
    if (!modalEl) return;

    modalEl.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        if (!btn) return;

        const ruolo = btn.getAttribute('data-ruolo') || '';
        const avatar = document.getElementById('detUtenteAvatar');
        const imgPath = btn.getAttribute('data-immagine') || '';
        avatar.textContent = '';
        if (imgPath) {
            const img = document.createElement('img');
            img.src = '/studio-essenza/' + imgPath;
            img.alt = (btn.getAttribute('data-nome') || '') + ' ' + (btn.getAttribute('data-cognome') || '');
            avatar.appendChild(img);
        } else {
            avatar.textContent = btn.getAttribute('data-iniziali') || '';
        }

        document.getElementById('detUtenteNome').textContent = (btn.getAttribute('data-cognome') || '') + ' ' + (btn.getAttribute('data-nome') || '');
        const ruoloEl = document.getElementById('detUtenteRuolo');
        ruoloEl.className = 'admin-role-pill is-' + ruolo;
        ruoloEl.textContent = ruolo;

        document.getElementById('detUtenteEmail').textContent = btn.getAttribute('data-email') || '-';
        document.getElementById('detUtenteTelefono').textContent = btn.getAttribute('data-telefono') || 'Non inserito';
        document.getElementById('detUtenteNascita').textContent = btn.getAttribute('data-nascita') || 'Non inserita';
        document.getElementById('detUtenteRegistrazione').textContent = btn.getAttribute('data-registrazione') || '-';

        const extraAllievo = document.getElementById('detUtenteExtraAllievo');
        const extraIstr = document.getElementById('detUtenteExtraIstruttore');
        extraAllievo.classList.toggle('d-none', ruolo !== 'allievo');
        extraIstr.classList.toggle('d-none', ruolo !== 'istruttore');

        if (ruolo === 'allievo') {
            document.getElementById('detUtenteCrediti').textContent = btn.getAttribute('data-crediti') || '0';
            const cert = btn.getAttribute('data-certificato') || '';
            const valido = btn.getAttribute('data-certificato-valido') === '1';
            document.getElementById('detUtenteCertificato').textContent = cert
                ? (valido ? 'Valido fino al ' + cert : 'Scaduto (' + cert + ')')
                : 'Non presente';
        }
        if (ruolo === 'istruttore') {
            document.getElementById('detUtenteTariffa').textContent = btn.getAttribute('data-tariffa') || 'Su richiesta';
            document.getElementById('detUtenteDescrizione').textContent = btn.getAttribute('data-descrizione') || 'Nessuna descrizione inserita';
        }
    });
});
</script>
{/literal}
{/block}
