<!-- File: Smarty/templates/admin_allievi.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container admin-wide-page py-2 py-md-3">

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

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Amministrazione</span>
                <h1 class="dashboard-title">Elenco Allievi</h1>
                <p class="dashboard-subtitle">
                    Consulta l'anagrafica completa di tutti gli allievi iscritti a Studio Essenza e visualizza le informazioni dettagliate di ciascun profilo.
                </p>
            </div>
            <div class="calendar-status-group">
                <div class="calendar-crediti-pill">
                    <span class="calendar-crediti-label">Allievi iscritti</span>
                    <div class="calendar-crediti-valore">
                        {$allievi|@count}
                        <small>{if $allievi|@count == 1}allievo{else}allievi{/if}</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabella Allievi -->
    <section class="dashboard-card">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <h2 class="dashboard-section-title">Tutti gli Allievi</h2>
                <span class="dashboard-count-badge" id="allieviCountBadge">
                    {$allievi|@count} {if $allievi|@count == 1}allievo{else}allievi{/if}
                </span>
            </div>

            {if !empty($allievi)}
                <div style="min-width: 260px;">
                    <input
                        type="search"
                        id="cercaAllievo"
                        class="form-control admin-input"
                        placeholder="Cerca per nome, cognome o email..."
                        aria-label="Cerca allievo"
                    >
                </div>
            {/if}
        </div>

        {if empty($allievi)}
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun allievo registrato</p>
                <p class="dashboard-empty-text">Non risultano ancora allievi iscritti nel sistema.</p>
            </div>
        {else}
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0" id="tabellaAllievi">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Data di nascita</th>
                            <th>Crediti</th>
                            <th>Certificato Medico</th>
                            <th class="text-end">Informazioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$allievi item=a}
                            <tr class="js-riga-allievo" data-search="{$a.cognome|lower|escape} {$a.nome|lower|escape} {$a.email|lower|escape}">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="admin-avatar-sm">
                                            {if !empty($a.immagine_profilo)}
                                                <img src="/studio-essenza/{$a.immagine_profilo|escape}" alt="{$a.nome|escape} {$a.cognome|escape}">
                                            {else}
                                                {$a.iniziali|escape}
                                            {/if}
                                        </span>
                                        <strong>{$a.cognome|escape} {$a.nome|escape}</strong>
                                    </div>
                                </td>
                                <td>{$a.email|escape}</td>
                                <td>{$a.telefono|default:'-'|escape}</td>
                                <td>{$a.data_nascita|default:'-'|escape}</td>
                                <td><strong>{$a.crediti_residui}</strong></td>
                                <td>
                                    {if !empty($a.scadenza_certificato)}
                                        {if $a.certificato_valido}
                                            <span class="dashboard-status-pill is-confirmed">
                                                {$a.scadenza_certificato|escape}
                                            </span>
                                        {else}
                                            <span class="dashboard-status-pill is-cancelled">
                                                Scaduto ({$a.scadenza_certificato|escape})
                                            </span>
                                        {/if}
                                    {else}
                                        <span class="text-muted small">Non presente</span>
                                    {/if}
                                </td>
                                <td class="text-end text-nowrap">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-essenza js-apri-dettaglio-allievo"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDettaglioAllievo"
                                        data-allievo-id="{$a.id}"
                                    >
                                        Dettagli
                                    </button>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div id="nessunRisultatoRicerca" class="dashboard-empty mt-3 d-none">
                <p class="dashboard-empty-title">Nessun allievo trovato</p>
                <p class="dashboard-empty-text">Prova a modificare i termini di ricerca.</p>
            </div>
        {/if}
    </section>

</div>

<!-- MODALE SCHEDA DETTAGLIO ALLIEVO -->
<div class="modal fade" id="modalDettaglioAllievo" tabindex="-1" aria-labelledby="modalDettaglioAllievoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="modalDettaglioAllievoLabel" style="color: #4a4a4a;">Scheda Allievo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center gap-3 pb-3 mb-3 border-bottom">
                    <div class="profile-avatar" id="detAllievoAvatar"></div>
                    <div>
                        <h3 class="h5 fw-bold mb-1" id="detAllievoNome" style="color: #4a4a4a;"></h3>
                        <span class="admin-role-pill is-allievo">Allievo</span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Email</div>
                            <div class="fw-semibold" id="detAllievoEmail"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Telefono</div>
                            <div class="fw-semibold" id="detAllievoTelefono"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Data di nascita</div>
                            <div class="fw-semibold" id="detAllievoNascita"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Data di registrazione</div>
                            <div class="fw-semibold" id="detAllievoRegistrazione"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #f7f8f5; border: 1px solid rgba(123, 139, 111, 0.2);">
                            <div class="text-muted small text-uppercase mb-1">Crediti residui</div>
                            <div class="fw-bold fs-5" style="color: #7b8b6f;" id="detAllievoCrediti"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Certificato medico</div>
                            <div id="detAllievoCertificato"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="p-3 rounded-3" style="background-color: #faf9f7; border: 1px solid #eceae4;">
                            <div class="text-muted small text-uppercase mb-1">Stato password</div>
                            <div class="fw-semibold small" id="detAllievoPassword"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <h4 class="h6 fw-semibold mb-2" style="color: #5f6e54;">Corsi di gruppo prenotati</h4>
                        <div id="detAllievoGruppo" class="small text-muted"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4 class="h6 fw-semibold mb-2" style="color: #5f6e54;">Lezioni individuali prenotate</h4>
                        <div id="detAllievoIndividuali" class="small text-muted"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-essenza" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<script id="dati-dettagli-allievi" type="application/json">{$allievi_json nofilter}</script>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Ricerca rapida nella tabella allievi
    const inputRicerca = document.getElementById('cercaAllievo');
    const righe = Array.from(document.querySelectorAll('.js-riga-allievo'));
    const badgeCount = document.getElementById('allieviCountBadge');
    const msgVuoto = document.getElementById('nessunRisultatoRicerca');

    if (inputRicerca && righe.length > 0) {
        inputRicerca.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            let visibili = 0;
            righe.forEach(function (tr) {
                const match = !q || (tr.getAttribute('data-search') || '').indexOf(q) !== -1;
                tr.classList.toggle('d-none', !match);
                if (match) visibili++;
            });
            if (badgeCount) {
                badgeCount.textContent = visibili + (visibili === 1 ? ' allievo' : ' allievi');
            }
            if (msgVuoto) {
                msgVuoto.classList.toggle('d-none', visibili > 0);
            }
        });
    }

    // 2. Popolamento modale scheda completa allievo
    const jsonEl = document.getElementById('dati-dettagli-allievi');
    const datiAllievi = jsonEl ? JSON.parse(jsonEl.textContent || '{}') : {};
    const modalEl = document.getElementById('modalDettaglioAllievo');

    if (modalEl) {
        modalEl.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;
            const id = btn.getAttribute('data-allievo-id');
            const a = datiAllievi[id];
            if (!a) return;

            const avatar = document.getElementById('detAllievoAvatar');
            avatar.textContent = '';
            if (a.immagine_profilo) {
                const img = document.createElement('img');
                img.src = '/studio-essenza/' + a.immagine_profilo;
                img.alt = a.nome + ' ' + a.cognome;
                avatar.appendChild(img);
            } else {
                avatar.textContent = a.iniziali || '';
            }

            document.getElementById('detAllievoNome').textContent = a.cognome + ' ' + a.nome;
            document.getElementById('detAllievoEmail').textContent = a.email || '-';
            document.getElementById('detAllievoTelefono').textContent = a.telefono || 'Non inserito';
            document.getElementById('detAllievoNascita').textContent = a.data_nascita
                ? (a.eta !== null ? a.data_nascita + ' (' + a.eta + ' anni)' : a.data_nascita)
                : 'Non inserita';
            document.getElementById('detAllievoRegistrazione').textContent = a.data_registrazione || '-';
            document.getElementById('detAllievoCrediti').textContent = a.crediti_residui + (a.crediti_residui === 1 ? ' ingresso' : ' ingressi');

            const certBox = document.getElementById('detAllievoCertificato');
            certBox.textContent = '';
            if (a.scadenza_certificato) {
                const pill = document.createElement('span');
                pill.className = 'dashboard-status-pill ' + (a.certificato_valido ? 'is-confirmed' : 'is-cancelled');
                pill.textContent = a.certificato_valido
                    ? 'Valido fino al ' + a.scadenza_certificato
                    : 'Scaduto (' + a.scadenza_certificato + ')';
                certBox.appendChild(pill);
            } else {
                const span = document.createElement('span');
                span.className = 'text-muted small';
                span.textContent = 'Non presente';
                certBox.appendChild(span);
            }

            document.getElementById('detAllievoPassword').textContent = a.deve_cambiare_password
                ? 'Password iniziale (da cambiare)'
                : 'Password personale attiva';

            const gruppoBox = document.getElementById('detAllievoGruppo');
            gruppoBox.textContent = '';
            if (a.prenotazioni_gruppo && a.prenotazioni_gruppo.length > 0) {
                const ul = document.createElement('ul');
                ul.className = 'list-unstyled mb-0 d-flex flex-column gap-1';
                a.prenotazioni_gruppo.forEach(function (g) {
                    const li = document.createElement('li');
                    li.className = 'p-2 rounded-2';
                    li.style.backgroundColor = '#faf9f7';
                    li.style.border = '1px solid #eceae4';
                    const strong = document.createElement('strong');
                    strong.textContent = g.corso;
                    li.appendChild(strong);
                    li.appendChild(document.createTextNode(' — ' + g.data_ora));
                    ul.appendChild(li);
                });
                gruppoBox.appendChild(ul);
            } else {
                gruppoBox.textContent = 'Nessun corso di gruppo in programma.';
            }

            const indBox = document.getElementById('detAllievoIndividuali');
            indBox.textContent = '';
            if (a.lezioni_individuali && a.lezioni_individuali.length > 0) {
                const ul = document.createElement('ul');
                ul.className = 'list-unstyled mb-0 d-flex flex-column gap-1';
                a.lezioni_individuali.forEach(function (ind) {
                    const li = document.createElement('li');
                    li.className = 'p-2 rounded-2';
                    li.style.backgroundColor = '#faf9f7';
                    li.style.border = '1px solid #eceae4';
                    const strong = document.createElement('strong');
                    strong.textContent = ind.istruttore;
                    li.appendChild(strong);
                    li.appendChild(document.createTextNode(' — ' + ind.data_ora));
                    ul.appendChild(li);
                });
                indBox.appendChild(ul);
            } else {
                indBox.textContent = 'Nessuna lezione individuale in programma.';
            }
        });
    }
});
</script>
{/literal}
{/block}
