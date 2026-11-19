<!-- File: Smarty/templates/calendario.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-4">

    <!-- Intestazione e stato rapido dell'allievo -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h3 mb-1" style="color: #7b8b6f;">Prenota una Lezione</h1>
            <p class="text-muted mb-0">
                Crediti residui: <span class="badge bg-dark fs-6">{$crediti_residui}</span>
                &nbsp;&bull;&nbsp;
                Certificato medico:
                {if $certificato_valido}
                    <span class="badge bg-success">Valido</span>
                {else}
                    <span class="badge bg-danger">Non valido / Scaduto</span>
                {/if}
            </p>
        </div>
        <a href="index.php?controller=utente&action=dashboard" class="btn btn-secondary">&larr; Torna alla Dashboard</a>
    </div>

    <!-- ===================================================================== -->
    <!-- SEZIONE 1: LEZIONI INDIVIDUALI (Scelta Istruttore + Mini-Calendario)  -->
    <!-- ===================================================================== -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-5">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4 flex-wrap gap-2">
            <div>
                <h2 class="h5 mb-0" style="color: #7b8b6f;">Lezioni Individuali (1 ora)</h2>
                <small class="text-muted">Seleziona un istruttore a sinistra per visualizzare nel mini-calendario a destra i giorni e gli orari disponibili.</small>
            </div>
            <span class="badge rounded-pill" style="background-color: #eef1ec; color: #5f6e54;">1 Credito a lezione</span>
        </div>

        {if empty($istruttori)}
            <p class="text-muted mb-0">Al momento non ci sono istruttori disponibili per lezioni individuali.</p>
        {else}
            <div class="row g-4 align-items-stretch">

                <!-- COLONNA SINISTRA: Elenco Istruttori -->
                <div class="col-12 col-lg-5">
                    <div class="list-group" id="lista-istruttori">
                        {foreach $istruttori as $istr}
                            <button type="button"
                                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 istruttore-item {if $istr@first}active{/if}"
                                    data-istruttore-id="{$istr.id}"
                                    data-istruttore-nome="{$istr.nome} {$istr.cognome}">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                         style="width: 44px; height: 44px; background-color: #7b8b6f; color: #fff;">
                                        {$istr.iniziali}
                                    </div>
                                    <div class="text-start">
                                        <div class="fw-bold">{$istr.nome} {$istr.cognome}</div>
                                        <small class="opacity-75">Istruttore certificato</small>
                                    </div>
                                </div>
                                <span class="badge rounded-pill {if $istr.totale_slot > 0}bg-light text-dark{else}bg-secondary{/if}">
                                    {$istr.totale_slot} slot
                                </span>
                            </button>
                        {/foreach}
                    </div>
                </div>

                <!-- COLONNA DESTRA: Mini-Calendario Giorni e Fasce Orarie -->
                <div class="col-12 col-lg-7">
                    <div class="border rounded-3 p-3 p-md-4 h-100 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h6 fw-bold mb-0" style="color: #5f6e54;">
                                Disponibilità di <span id="nome-istruttore-selezionato">{$istruttori[0].nome} {$istruttori[0].cognome}</span>
                            </h3>
                            <span class="small text-muted">Durata: 60 min</span>
                        </div>

                        <!-- Barra dei giorni disponibili (mini-calendario) -->
                        <div id="mini-calendario-giorni" class="d-flex gap-2 flex-wrap mb-3 pb-3 border-bottom">
                            <!-- Popolato via JS -->
                        </div>

                        <!-- Fasce orarie del giorno selezionato -->
                        <div id="mini-calendario-orari">
                            <!-- Popolato via JS -->
                        </div>
                    </div>
                </div>

            </div>
        {/if}
    </div>

    <!-- ===================================================================== -->
    <!-- SEZIONE 2: CORSI DI GRUPPO (Calendario gestito dall'Admin)            -->
    <!-- ===================================================================== -->
    <div class="bg-white rounded-3 shadow-sm p-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Calendario Corsi di Gruppo</h2>

        {if empty($lezioni)}
            <p class="text-muted mb-0">Non ci sono lezioni di gruppo in programma al momento.</p>
        {else}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Corso</th>
                            <th>Istruttore</th>
                            <th>Data</th>
                            <th>Orario</th>
                            <th>Posti</th>
                            <th class="text-end">Prenotazione</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $lezioni as $lez}
                            <tr>
                                <td><strong>{$lez.nome_corso}</strong></td>
                                <td>{$lez.istruttore}</td>
                                <td>{$lez.data}</td>
                                <td>{$lez.ora_inizio} - {$lez.ora_fine}</td>
                                <td>{$lez.posti_occupati} / {$lez.capienza_max}</td>
                                <td class="text-end">
                                    {if $lez.gia_prenotata}
                                        <span class="badge bg-success">Già prenotato</span>
                                    {elseif $lez.posti_occupati >= $lez.capienza_max}
                                        <span class="badge bg-secondary">Completo</span>
                                    {else}
                                        <form action="index.php?controller=prenotazione&action=prenota" method="POST" class="d-inline">
                                            <input type="hidden" name="id_lezione" value="{$lez.id}">
                                            <button type="submit" class="btn btn-sm btn-primary">Prenota</button>
                                        </form>
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

<!-- Dati JSON degli slot individuali passati dal Controller -->
<script id="dati-slot-individuali" type="application/json">{$slot_individuali_json nofilter}</script>

{literal}
<style>
    /* Evidenziazione dell'istruttore attivo con il verde Studio Essenza */
    #lista-istruttori .istruttore-item.active {
        background-color: #7b8b6f;
        border-color: #7b8b6f;
        color: #ffffff;
    }
    .btn-giorno-cal.active {
        background-color: #7b8b6f !important;
        border-color: #7b8b6f !important;
        color: #ffffff !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jsonEl = document.getElementById('dati-slot-individuali');
    if (!jsonEl) return;

    const slotPerIstruttore = JSON.parse(jsonEl.textContent || '{}');
    const containerGiorni = document.getElementById('mini-calendario-giorni');
    const containerOrari = document.getElementById('mini-calendario-orari');
    const labelIstruttore = document.getElementById('nome-istruttore-selezionato');
    const bottoniIstruttori = document.querySelectorAll('.istruttore-item');

    function renderOrariGiorno(giornoObj) {
        if (!giornoObj || !giornoObj.orari || giornoObj.orari.length === 0) {
            containerOrari.innerHTML = '<p class="text-muted small mb-0">Nessuna fascia oraria disponibile per questa data.</p>';
            return;
        }

        let html = '<div class="row g-2">';
        giornoObj.orari.forEach(function (slot) {
            html += `
                <div class="col-12 col-sm-6">
                    <div class="bg-white border rounded-2 p-2 px-3 d-flex justify-content-between align-items-center shadow-sm">
                        <div>
                            <strong class="d-block">${slot.ora_inizio} - ${slot.ora_fine}</strong>
                            <small class="text-muted">Lezione 1-to-1</small>
                        </div>
                        <form action="index.php?controller=prenotazione&action=prenotaIndividuale" method="POST" class="m-0">
                            <input type="hidden" name="id_slot" value="${slot.id_slot}">
                            <button type="submit" class="btn btn-sm btn-primary">Prenota</button>
                        </form>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        containerOrari.innerHTML = html;
    }

    function renderCalendarioIstruttore(idIstruttore, nomeIstruttore) {
        labelIstruttore.textContent = nomeIstruttore;
        const giorni = slotPerIstruttore[idIstruttore] || [];

        if (giorni.length === 0) {
            containerGiorni.innerHTML = '';
            containerOrari.innerHTML = `
                <div class="text-center py-4 text-muted">
                    <p class="mb-1 fw-semibold">Nessuna disponibilità inserita al momento</p>
                    <small>Seleziona un altro istruttore dall'elenco a sinistra.</small>
                </div>
            `;
            return;
        }

        containerGiorni.innerHTML = '';
        giorni.forEach(function (giorno, index) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-sm btn-outline-secondary btn-giorno-cal text-start' + (index === 0 ? ' active' : '');
            btn.innerHTML = `<small class="d-block opacity-75">${giorno.giorno_settimana}</small><strong>${giorno.data_label}</strong>`;
            btn.addEventListener('click', function () {
                document.querySelectorAll('.btn-giorno-cal').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                renderOrariGiorno(giorno);
            });
            containerGiorni.appendChild(btn);
        });

        // Mostra subito gli orari del primo giorno disponibile
        renderOrariGiorno(giorni[0]);
    }

    bottoniIstruttori.forEach(function (btn) {
        btn.addEventListener('click', function () {
            bottoniIstruttori.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderCalendarioIstruttore(
                btn.getAttribute('data-istruttore-id'),
                btn.getAttribute('data-istruttore-nome')
            );
        });
    });

    // Inizializza con il primo istruttore della lista
    if (bottoniIstruttori.length > 0) {
        const primo = bottoniIstruttori[0];
        renderCalendarioIstruttore(
            primo.getAttribute('data-istruttore-id'),
            primo.getAttribute('data-istruttore-nome')
        );
    }
});
</script>
{/literal}
{/block}