<!-- File: Smarty/templates/istruttore_dashboard.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-4">

    <!-- Intestazione -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar">
                    {if !empty($immagine_profilo)}
                        <img src="/studio-essenza/{$immagine_profilo|escape}" alt="{$nome_istruttore|escape} {$cognome_istruttore|escape}">
                    {else}
                        {$iniziali_istruttore|default:''|escape}
                    {/if}
                </div>
                <button
                    type="button"
                    class="profile-avatar-edit-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#modalFotoProfiloIstruttore"
                    title="Modifica immagine profilo"
                    aria-label="Modifica immagine profilo"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                </button>
            </div>
            <div>
                <h1 class="h3 mb-1" style="color: #7b8b6f;">Area Istruttore</h1>
                <p class="text-muted mb-0">Benvenuto/a, <strong>{$nome_istruttore|escape} {$cognome_istruttore|escape}</strong> &bull; {$email_istruttore|escape}</p>
            </div>
        </div>
        <div class="d-flex align-items-center flex-wrap gap-2">
            <a href="index.php?controller=utente&action=cambiaPassword" class="btn btn-outline-essenza">
                Cambia Password
            </a>
            <button type="button" class="btn btn-outline-essenza" data-bs-toggle="modal" data-bs-target="#modalFotoProfiloIstruttore">
                Foto Profilo
            </button>
            <a href="index.php?controller=utente&action=logout" class="btn btn-outline-danger">Esci</a>
        </div>
    </div>

    <!-- Avviso promemoria cambio password iniziale -->
    {if !empty($mostra_avviso_password)}
        <div class="alert password-reminder-alert fade show d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4 shadow-sm" id="avvisoCambioPassword" role="alert">
            <div class="d-flex align-items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <div>
                    <strong class="d-block mb-1">Ricordati di cambiare la tua password</strong>
                    <span>Il tuo profilo è stato creato dalla segreteria con una password iniziale. Ti consigliamo di impostarne una personale.</span>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 flex-shrink-0">
                <a href="index.php?controller=utente&action=cambiaPassword" class="btn btn-primary btn-sm px-3 text-nowrap">
                    Cambia password
                </a>
                <button
                    type="button"
                    class="btn btn-outline-essenza btn-sm px-3 text-nowrap js-chiudi-avviso-password"
                    data-bs-dismiss="alert"
                    aria-label="Chiudi avviso"
                >
                    Chiudi
                </button>
            </div>
        </div>
    {/if}

    <!-- Messaggi di conferma / errore -->
    {if isset($messaggio_successo)}
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {$messaggio_successo}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}
    {if isset($messaggio_errore)}
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {$messaggio_errore}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    {/if}

    <!-- Riepilogo Numerico Rapido -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold" style="color: #7b8b6f;">{$corsi_futuri|count}</div>
                <div class="text-muted small">Corsi di gruppo in programma</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold text-success">{$conteggio_prenotate}</div>
                <div class="text-muted small">Lezioni individuali prenotate</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold text-secondary">{$conteggio_disponibili}</div>
                <div class="text-muted small">Slot individuali ancora liberi</div>
            </div>
        </div>
    </div>

    <!-- SEZIONE 1: GESTIONE LEZIONI INDIVIDUALI (1 ora) -->
    <div class="row g-4 mb-4">

        <!-- Colonna Sinistra: Tariffa Individuale + Inserimento Fasce Orarie -->
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">
            <!-- Gestione Tariffa Individuale -->
            <div class="bg-white rounded-3 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center gap-2 pb-2 mb-3 border-bottom">
                    <h2 class="h5 mb-0" style="color: #7b8b6f;">Tariffa Lezione Individuale</h2>
                    <span class="dashboard-count-badge">
                        {if !empty($tariffa_formattata)}
                            {$tariffa_formattata|escape} / ora
                        {else}
                            Da impostare
                        {/if}
                    </span>
                </div>
                <p class="text-muted small mb-3">
                    Imposta il costo della tua lezione 1-to-1 (60 min). Il prezzo verrà mostrato automaticamente agli allievi nel calendario e nella pagina Tariffe.
                </p>

                <form action="index.php?controller=istruttore&action=aggiornaTariffa" method="POST">
                    <div class="mb-3">
                        <label for="tariffa_individuale" class="form-label fw-semibold">Costo per lezione (1 ora)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">&euro;</span>
                            <input
                                type="number"
                                id="tariffa_individuale"
                                name="tariffa_individuale"
                                class="form-control"
                                min="1"
                                max="9999.99"
                                step="0.50"
                                data-msg-min="La tariffa individuale deve essere almeno 1 €."
                                data-msg-max="La tariffa individuale non può superare 9999,99 €."
                                placeholder="Es. 45"
                                value="{if $tariffa_individuale !== null}{$tariffa_individuale}{/if}"
                            >
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Salva Tariffa</button>
                </form>
            </div>

            <!-- Inserimento Fasce Orarie -->
            <div class="bg-white rounded-3 shadow-sm p-4 flex-grow-1">
                <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Inserisci Disponibilità</h2>
                <p class="text-muted small">
                    Scegli giorno e fascia oraria: il sistema creerà automaticamente slot prenotabili da <strong>1 ora</strong>, evitando sovrapposizioni con i tuoi corsi.
                </p>

                <form action="index.php?controller=istruttore&action=aggiungiDisponibilita" method="POST">
                    <div class="mb-3">
                        <label for="data" class="form-label fw-semibold">Data</label>
                        <input
                            type="date"
                            id="data"
                            name="data"
                            class="form-control"
                            min="{$oggi_input}"
                            required
                            data-msg-required="Seleziona una data per la disponibilità."
                            data-msg-min="Non puoi selezionare una data già trascorsa."
                        >
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label for="ora_inizio" class="form-label fw-semibold">Dalle</label>
                            <select id="ora_inizio" name="ora_inizio" class="form-select" required data-msg-required="Seleziona l'orario di inizio.">
                                {section name=h start=8 loop=21}
                                    <option value="{$smarty.section.h.index}">
                                        {if $smarty.section.h.index < 10}0{/if}{$smarty.section.h.index}:00
                                    </option>
                                {/section}
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="ora_fine" class="form-label fw-semibold">Alle</label>
                            <select id="ora_fine" name="ora_fine" class="form-select" required data-msg-required="Seleziona l'orario di fine." data-gt-target="ora_inizio" data-msg-gt="L'orario di fine deve essere successivo a quello di inizio.">
                                {section name=h start=9 loop=22}
                                    <option value="{$smarty.section.h.index}" {if $smarty.section.h.index == 11}selected{/if}>
                                        {if $smarty.section.h.index < 10}0{/if}{$smarty.section.h.index}:00
                                    </option>
                                {/section}
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Salva Disponibilità</button>
                </form>
            </div>
        </div>

        <!-- Colonna Destra: Elenco Slot e Prenotazioni Individuali -->
        <div class="col-12 col-lg-8">
            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Agenda Lezioni Individuali</h2>

                {if empty($lezioni_individuali)}
                    <p class="text-muted mb-0">Non hai ancora inserito disponibilità future. Usa il modulo a sinistra per aprire nuovi slot orari.</p>
                {else}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Data e Ora</th>
                                    <th>Stato</th>
                                    <th>Allievo / Note</th>
                                    <th class="text-end">Azione</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $lezioni_individuali as $slot}
                                    <tr>
                                        <td class="text-nowrap">
                                            <strong>{$slot.data_formattata}</strong><br>
                                            <small class="text-muted">{$slot.ora_inizio} - {$slot.ora_fine}</small>
                                        </td>
                                        <td>
                                            {if $slot.stato == 'prenotata'}
                                                <span class="badge bg-success">Prenotata</span>
                                            {elseif $slot.stato == 'disponibile'}
                                                <span class="badge bg-secondary">Disponibile</span>
                                            {else}
                                                <span class="badge bg-danger">Annullata</span>
                                            {/if}
                                        </td>
                                        <td>
                                            {if $slot.stato == 'prenotata'}
                                                <strong>{$slot.allievo_nome}</strong><br>
                                                <small class="text-muted">{$slot.allievo_telefono|default:$slot.allievo_email}</small>
                                            {elseif $slot.stato == 'annullata_istruttore'}
                                                <span class="text-muted small">Allievo: {$slot.allievo_nome|default:'-'}</span><br>
                                                <small class="text-danger"><strong>Motivo:</strong> {$slot.motivazione}</small>
                                            {else}
                                                <span class="text-muted small">In attesa di prenotazione</span>
                                            {/if}
                                        </td>
                                        <td class="text-end text-nowrap">
                                            {if $slot.stato == 'disponibile'}
                                                <form action="index.php?controller=istruttore&action=rimuoviDisponibilita" method="POST" class="d-inline">
                                                    <input type="hidden" name="id_slot" value="{$slot.id}">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Rimuovi</button>
                                                </form>
                                            {elseif $slot.stato == 'prenotata'}
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalAnnullaIndividuale"
                                                        data-id="{$slot.id}"
                                                        data-dettagli="{$slot.allievo_nome|escape:'html'} ({$slot.data_formattata} {$slot.ora_inizio}-{$slot.ora_fine})">
                                                    Annulla
                                                </button>
                                            {else}
                                                <span class="text-muted small">&mdash;</span>
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                {/if}
            </div>
        </div>

    </div>

    <!-- SEZIONE 2: CORSI DI GRUPPO ASSEGNATI DALL'ADMIN -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Corsi di Gruppo Assegnati</h2>

        {if empty($corsi_futuri)}
            <p class="text-muted mb-0">Non risultano corsi di gruppo in programma assegnati al tuo profilo.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Corso</th>
                            <th>Data</th>
                            <th>Orario</th>
                            <th>Iscritti</th>
                            <th class="text-end">Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $corsi_futuri as $corso}
                            <tr>
                                <td><strong>{$corso.nome_corso}</strong></td>
                                <td>{$corso.data_formattata}</td>
                                <td>{$corso.ora_inizio} - {$corso.ora_fine}</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: #eef1ec; color: #5f6e54;">
                                        {$corso.num_iscritti} / {$corso.capienza_max} posti
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="index.php?controller=istruttore&action=appello&id_lezione={$corso.id_lezione}" class="btn btn-sm btn-primary">Apri Appello</a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        {/if}
    </div>

    <!-- Storico Corsi Svolti (se presenti) -->
    {if !empty($corsi_passati)}
        <div class="bg-white rounded-3 shadow-sm p-4 opacity-75">
            <h2 class="h6 pb-2 mb-3 border-bottom text-secondary">Storico Corsi di Gruppo Svolti</h2>
            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Corso</th>
                            <th>Data</th>
                            <th>Orario</th>
                            <th>Iscritti</th>
                            <th class="text-end">Dettagli</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $corsi_passati as $corso}
                            <tr>
                                <td>{$corso.nome_corso}</td>
                                <td>{$corso.data_formattata}</td>
                                <td>{$corso.ora_inizio} - {$corso.ora_fine}</td>
                                <td>{$corso.num_iscritti} / {$corso.capienza_max}</td>
                                <td class="text-end">
                                    <a href="index.php?controller=istruttore&action=appello&id_lezione={$corso.id_lezione}" class="text-decoration-none fw-semibold" style="color: #7b8b6f;">Vedi elenco</a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    {/if}

</div>

<!-- MODALE BOOTSTRAP PER ANNULLAMENTO LEZIONE INDIVIDUALE -->
<div class="modal fade" id="modalAnnullaIndividuale" tabindex="-1" aria-labelledby="modalAnnullaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="index.php?controller=istruttore&action=annullaIndividuale" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="modalAnnullaLabel">Annulla Lezione Individuale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_slot" id="modal_id_slot" value="">
                    <p class="small text-muted mb-2">
                        Stai annullando la lezione prenotata da: <br>
                        <strong id="modal_dettagli_lezione" class="text-dark"></strong>
                    </p>
                    <p class="small text-muted mb-3">
                        L'allievo vedrà la motivazione dell'annullamento direttamente nella propria dashboard.
                    </p>
                    <div class="mb-2">
                        <label for="motivazione" class="form-label fw-semibold">Motivazione dell'annullamento *</label>
                        <textarea class="form-control" id="motivazione" name="motivazione" rows="3" required data-msg-required="Inserisci la motivazione dell'annullamento prima di confermare." placeholder="Es. Imprevisto personale, riprogrammiamo nei prossimi giorni..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-danger">Conferma Annullamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODALE CARICAMENTO IMMAGINE PROFILO ISTRUTTORE -->
<div class="modal fade" id="modalFotoProfiloIstruttore" tabindex="-1" aria-labelledby="modalFotoProfiloIstruttoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="modalFotoProfiloIstruttoreLabel" style="color: #4a4a4a;">Immagine Profilo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="profile-avatar-preview mx-auto" id="previewFotoIstruttore">
                        {if !empty($immagine_profilo)}
                            <img src="/studio-essenza/{$immagine_profilo|escape}" alt="{$nome_istruttore|escape} {$cognome_istruttore|escape}">
                        {else}
                            {$iniziali_istruttore|default:''|escape}
                        {/if}
                    </div>
                </div>

                <form action="index.php?controller=istruttore&action=aggiornaImmagineProfilo" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputFotoIstruttore" class="form-label auth-label">Scegli una nuova immagine</label>
                        <input
                            type="file"
                            id="inputFotoIstruttore"
                            name="immagine_profilo"
                            class="form-control admin-input"
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            required
                            data-msg-required="Seleziona un'immagine dal tuo dispositivo prima di salvare."
                        >
                        <div class="form-text mt-1">Questa foto comparirà anche nel carosello della homepage e nel calendario prenotazioni (max 5 MB).</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-essenza" data-bs-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva Immagine</button>
                    </div>
                </form>

                {if !empty($immagine_profilo)}
                    <hr class="auth-divider my-3">
                    <form action="index.php?controller=istruttore&action=rimuoviImmagineProfilo" method="POST" class="text-center" onsubmit="return confirm('Vuoi davvero rimuovere la tua immagine profilo?');">
                        <button type="submit" class="btn btn-sm btn-disdici">Rimuovi immagine attuale</button>
                    </form>
                {/if}
            </div>
        </div>
    </div>
</div>

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btnChiudiAvviso = document.querySelector('.js-chiudi-avviso-password');
    if (btnChiudiAvviso) {
        btnChiudiAvviso.addEventListener('click', function () {
            fetch('index.php?controller=utente&action=chiudiAvvisoPassword', {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).catch(function () {});
        });
    }

    var modalEl = document.getElementById('modalAnnullaIndividuale');
    if (modalEl) {
        modalEl.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('modal_id_slot').value = button.getAttribute('data-id');
            document.getElementById('modal_dettagli_lezione').textContent = button.getAttribute('data-dettagli');
            document.getElementById('motivazione').value = '';
        });
    }

    var inputFoto = document.getElementById('inputFotoIstruttore');
    var previewFoto = document.getElementById('previewFotoIstruttore');
    if (inputFoto && previewFoto) {
        inputFoto.addEventListener('change', function () {
            var file = this.files && this.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                previewFoto.innerHTML = '<img src="' + e.target.result + '" alt="Anteprima immagine profilo">';
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
{/literal}
{/block}