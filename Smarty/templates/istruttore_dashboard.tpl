<!-- File: Smarty/templates/istruttore_dashboard.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-4">

    <!-- Intestazione -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h3 mb-1" style="color: #7b8b6f;">Area Istruttore</h1>
            <p class="text-muted mb-0">Benvenuto/a, <strong>{$nome_istruttore} {$cognome_istruttore}</strong> &bull; {$email_istruttore}</p>
        </div>
        <a href="index.php?controller=utente&action=logout" class="btn btn-outline-danger">Esci</a>
    </div>

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

        <!-- Colonna Sinistra: Inserimento Fasce Orarie -->
        <div class="col-12 col-lg-4">
            <div class="bg-white rounded-3 shadow-sm p-4 h-100">
                <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Inserisci Disponibilità</h2>
                <p class="text-muted small">
                    Scegli giorno e fascia oraria: il sistema creerà automaticamente slot prenotabili da <strong>1 ora</strong>, evitando sovrapposizioni con i tuoi corsi.
                </p>

                <form action="index.php?controller=istruttore&action=aggiungiDisponibilita" method="POST">
                    <div class="mb-3">
                        <label for="data" class="form-label fw-semibold">Data</label>
                        <input type="date" id="data" name="data" class="form-control" min="{$oggi_input}" required>
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label for="ora_inizio" class="form-label fw-semibold">Dalle</label>
                            <select id="ora_inizio" name="ora_inizio" class="form-select" required>
                                {section name=h start=8 loop=21}
                                    <option value="{$smarty.section.h.index}">
                                        {if $smarty.section.h.index < 10}0{/if}{$smarty.section.h.index}:00
                                    </option>
                                {/section}
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="ora_fine" class="form-label fw-semibold">Alle</label>
                            <select id="ora_fine" name="ora_fine" class="form-select" required>
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
                        All'allievo verrà automaticamente rimborsato 1 credito e vedrà la motivazione nella propria dashboard.
                    </p>
                    <div class="mb-2">
                        <label for="motivazione" class="form-label fw-semibold">Motivazione dell'annullamento *</label>
                        <textarea class="form-control" id="motivazione" name="motivazione" rows="3" required placeholder="Es. Imprevisto personale, riprogrammiamo nei prossimi giorni..."></textarea>
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

{literal}
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modalEl = document.getElementById('modalAnnullaIndividuale');
    if (modalEl) {
        modalEl.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('modal_id_slot').value = button.getAttribute('data-id');
            document.getElementById('modal_dettagli_lezione').textContent = button.getAttribute('data-dettagli');
            document.getElementById('motivazione').value = '';
        });
    }
});
</script>
{/literal}
{/block}