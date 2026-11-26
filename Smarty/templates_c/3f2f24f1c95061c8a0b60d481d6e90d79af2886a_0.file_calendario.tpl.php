<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:41:33
  from 'file:calendario.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b08613d7196c2_68065502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f2f24f1c95061c8a0b60d481d6e90d79af2886a' => 
    array (
      0 => 'calendario.tpl',
      1 => 1795710922,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b08613d7196c2_68065502 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/calendario.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14079707386b08613d700de8_11403867', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_14079707386b08613d700de8_11403867 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container dashboard-page py-2 py-md-3">

    <!-- Link ritorno alla Dashboard -->
    <div class="mb-3">
        <a href="index.php?controller=utente&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna alla Dashboard</span>
        </a>
    </div>

    <!-- Intestazione e stato rapido dell'allievo -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Calendario Prenotazioni</span>
                <h1 class="dashboard-title">Prenota una Lezione</h1>
                <p class="dashboard-subtitle">
                    Scegli una lezione individuale 1-to-1 oppure prenota il tuo posto nei corsi di gruppo.
                </p>
            </div>

            <div class="calendar-status-group">
                <div class="calendar-crediti-pill <?php if ($_smarty_tpl->getValue('crediti_residui') <= 0) {?>is-empty<?php }?>">
                    <span class="calendar-crediti-label">Crediti residui</span>
                    <div class="calendar-crediti-valore">
                        <?php echo $_smarty_tpl->getValue('crediti_residui');?>

                        <small><?php if ($_smarty_tpl->getValue('crediti_residui') == 1) {?>ingresso<?php } else { ?>ingressi<?php }?></small>
                    </div>
                </div>

                <div class="calendar-crediti-pill <?php if (!$_smarty_tpl->getValue('certificato_valido')) {?>is-invalid<?php }?>">
                    <span class="calendar-crediti-label">Certificato medico</span>
                    <div class="calendar-crediti-valore">
                        <?php if ($_smarty_tpl->getValue('certificato_valido')) {?>
                            Valido
                        <?php } else { ?>
                            Non valido
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Avvisi utili su crediti / certificato -->
    <?php if ($_smarty_tpl->getValue('crediti_residui') <= 0) {?>
        <div class="dashboard-avviso-rinnovo d-flex align-items-start gap-2 mb-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <div>
                <strong>Crediti esauriti per i corsi di gruppo:</strong> passa in segreteria per rinnovare il tuo pacchetto oppure
                <a href="index.php?controller=info&action=tariffe" class="auth-link">consulta le tariffe</a>. Le lezioni individuali restano prenotabili con pagamento separato.
            </div>
        </div>
    <?php }?>

    <?php if (!$_smarty_tpl->getValue('certificato_valido')) {?>
        <div class="auth-alert-error d-flex align-items-start gap-2 mb-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <div>
                <strong>Certificato medico non valido o scaduto:</strong> per prenotare le lezioni consegna il certificato aggiornato in segreteria.
            </div>
        </div>
    <?php }?>

    <!-- ===================================================================== -->
    <!-- SEZIONE 1: LEZIONI INDIVIDUALI (Scelta Istruttore + Mini-Calendario)  -->
    <!-- ===================================================================== -->
    <section class="dashboard-card mb-4">
        <div class="d-flex justify-content-between align-items-start align-items-sm-center flex-wrap gap-2 pb-3 mb-4 border-bottom">
            <div>
                <h2 class="dashboard-section-title mb-1">Lezioni Individuali (1 ora)</h2>
                <p class="dashboard-subtitle" style="font-size: 14.5px;">
                    Seleziona un istruttore a sinistra per visualizzare nel mini-calendario i giorni e gli orari disponibili.
                </p>
            </div>
            <span class="dashboard-count-badge">Pagamento separato</span>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('istruttori') || empty($_smarty_tpl->getValue('istruttori')))) {?>
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun istruttore disponibile</p>
                <p class="dashboard-empty-text">Al momento non ci sono istruttori disponibili per lezioni individuali.</p>
            </div>
        <?php } else { ?>
            <div class="row g-4 align-items-stretch">

                <!-- COLONNA SINISTRA: Elenco Istruttori -->
                <div class="col-12 col-lg-5">
                    <div class="list-group" id="lista-istruttori">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$_smarty_tpl->getVariable('istr')->index = -1;
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach4DoElse = false;
$_smarty_tpl->getVariable('istr')->index++;
$_smarty_tpl->getVariable('istr')->first = !$_smarty_tpl->getVariable('istr')->index;
$foreach4Backup = clone $_smarty_tpl->getVariable('istr');
?>
                            <button type="button"
                                    class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-3 istruttore-item <?php if ($_smarty_tpl->getVariable('istr')->first) {?>active<?php }?>"
                                    data-istruttore-id="<?php echo $_smarty_tpl->getValue('istr')['id'];?>
"
                                    data-istruttore-nome="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
"
                                    data-istruttore-tariffa="<?php if (!( !true || empty($_smarty_tpl->getValue('istr')['tariffa_formattata']))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['tariffa_formattata'], ENT_QUOTES, 'UTF-8', true);
} else { ?>Su richiesta<?php }?>">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="calendar-istruttore-avatar">
                                        <?php if (!( !true || empty($_smarty_tpl->getValue('istr')['immagine_profilo']))) {?>
                                            <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['immagine_profilo'], ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php } else { ?>
                                            <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['iniziali'], ENT_QUOTES, 'UTF-8', true);?>

                                        <?php }?>
                                    </div>
                                    <div class="text-start">
                                        <div class="fw-semibold"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                        <small class="opacity-75">Istruttore certificato</small>
                                    </div>
                                </div>
                                <span class="calendar-slot-badge <?php if ($_smarty_tpl->getValue('istr')['totale_slot'] == 0) {?>is-zero<?php }?>">
                                    <?php echo $_smarty_tpl->getValue('istr')['totale_slot'];?>
 slot
                                </span>
                            </button>
                        <?php
$_smarty_tpl->setVariable('istr', $foreach4Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </div>
                </div>

                <!-- COLONNA DESTRA: Mini-Calendario Giorni e Fasce Orarie -->
                <div class="col-12 col-lg-7">
                    <div class="calendar-mini-panel h-100">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <h3 class="h6 fw-semibold mb-0" style="color: #5f6e54;">
                                Disponibilità di <span id="nome-istruttore-selezionato"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istruttori')[0]['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istruttori')[0]['cognome'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                            </h3>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span id="tariffa-istruttore-selezionato" class="dashboard-count-badge">
                                    <?php if (!( !true || empty($_smarty_tpl->getValue('istruttori')[0]['tariffa_formattata']))) {?>
                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istruttori')[0]['tariffa_formattata'], ENT_QUOTES, 'UTF-8', true);?>
 / ora
                                    <?php } else { ?>
                                        Tariffa su richiesta
                                    <?php }?>
                                </span>
                                <span class="dashboard-count-badge">Durata: 60 min</span>
                            </div>
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
        <?php }?>
    </section>

    <!-- ===================================================================== -->
    <!-- SEZIONE 2: CORSI DI GRUPPO (Calendario gestito dall'Admin)            -->
    <!-- ===================================================================== -->
    <section class="dashboard-card">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 pb-3 mb-4 border-bottom">
            <div>
                <h2 class="dashboard-section-title mb-1">Calendario Corsi di Gruppo</h2>
                <p class="dashboard-subtitle" style="font-size: 14.5px;">
                    Lezioni in miniclassi programmate per i prossimi 7 giorni.
                </p>
            </div>
            <span class="dashboard-count-badge" id="calendarCountBadge">
                <?php if (( !$_smarty_tpl->hasVariable('lezioni') || empty($_smarty_tpl->getValue('lezioni')))) {?>
                    0 lezioni
                <?php } else { ?>
                    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('lezioni'));?>

                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('lezioni')) == 1) {?>lezione in programma<?php } else { ?>lezioni in programma<?php }?>
                <?php }?>
            </span>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('lezioni') || empty($_smarty_tpl->getValue('lezioni')))) {?>
            <div class="dashboard-empty">
                <div class="dashboard-empty-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <p class="dashboard-empty-title">Nessuna lezione di gruppo in programma</p>
                <p class="dashboard-empty-text">
                    Al momento non ci sono corsi di gruppo pianificati. Torna a controllare presto oppure prenota una lezione individuale qui sopra.
                </p>
            </div>
        <?php } else { ?>
            <!-- Filtri rapidi per disciplina (popolati via JS se presenti 2+ corsi) -->
            <div class="calendar-filters mb-4" id="calendarFilters" aria-label="Filtra per disciplina"></div>

            <!-- Griglia Card Lezioni di Gruppo -->
            <div class="row g-4" id="calendarGrid">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('lezioni'), 'lez');
$foreach5DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('lez')->value) {
$foreach5DoElse = false;
?>
                    <div class="col-12 col-md-6 col-lg-4 calendar-lesson-col" data-corso="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['nome_corso'], ENT_QUOTES, 'UTF-8', true);?>
">
                        <article class="calendar-lesson-card h-100 d-flex flex-column">
                            <div>
                                <span class="calendar-date-badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['data'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['ora_inizio'], ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['ora_fine'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                </span>

                                <h3 class="calendar-lesson-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['nome_corso'], ENT_QUOTES, 'UTF-8', true);?>
</h3>

                                <p class="calendar-lesson-meta">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lez')['istruttore'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                </p>

                                <p class="calendar-lesson-meta mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>Posti: <?php echo $_smarty_tpl->getValue('lez')['posti_occupati'];?>
 / <?php echo $_smarty_tpl->getValue('lez')['capienza_max'];?>
</span>
                                </p>
                            </div>

                            <div class="mt-auto pt-4">
                                <?php if ($_smarty_tpl->getValue('lez')['gia_prenotata']) {?>
                                    <div class="dashboard-status-pill is-confirmed w-100 text-center py-2">
                                        Già prenotato
                                    </div>
                                <?php } elseif ($_smarty_tpl->getValue('lez')['posti_occupati'] >= $_smarty_tpl->getValue('lez')['capienza_max']) {?>
                                    <button type="button" class="btn btn-outline-secondary calendar-book-btn w-100" disabled>
                                        Completo
                                    </button>
                                <?php } else { ?>
                                    <form action="index.php?controller=prenotazione&action=prenota" method="POST" class="m-0">
                                        <input type="hidden" name="id_lezione" value="<?php echo $_smarty_tpl->getValue('lez')['id'];?>
">
                                        <button type="submit" class="btn btn-primary calendar-book-btn w-100">
                                            Prenota Ora
                                        </button>
                                    </form>
                                <?php }?>
                            </div>
                        </article>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

</div>

<!-- Dati JSON degli slot individuali passati dal Controller -->
<?php echo '<script'; ?>
 id="dati-slot-individuali" type="application/json"><?php echo $_smarty_tpl->getValue('slot_individuali_json');
echo '</script'; ?>
>


<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', function () {
    /* 1. MINI-CALENDARIO LEZIONI INDIVIDUALI */
    const jsonEl = document.getElementById('dati-slot-individuali');
    const containerGiorni = document.getElementById('mini-calendario-giorni');
    const containerOrari = document.getElementById('mini-calendario-orari');
    const labelIstruttore = document.getElementById('nome-istruttore-selezionato');
    const labelTariffa = document.getElementById('tariffa-istruttore-selezionato');
    const bottoniIstruttori = document.querySelectorAll('.istruttore-item');

    if (jsonEl && containerGiorni && containerOrari) {
        const slotPerIstruttore = JSON.parse(jsonEl.textContent || '{}');
        let tariffaCorrente = 'Su richiesta';

        function renderOrariGiorno(giornoObj) {
            if (!giornoObj || !giornoObj.orari || giornoObj.orari.length === 0) {
                containerOrari.innerHTML = '<p class="text-muted small mb-0">Nessuna fascia oraria disponibile per questa data.</p>';
                return;
            }

            let html = '<div class="row g-2">';
            giornoObj.orari.forEach(function (slot) {
                html += `
                    <div class="col-12 col-sm-6">
                        <div class="calendar-slot-card">
                            <strong style="color: #4a4a4a;">${slot.ora_inizio} - ${slot.ora_fine}</strong>
                            <form action="index.php?controller=prenotazione&action=prenotaIndividuale" method="POST" class="m-0">
                                <input type="hidden" name="id_slot" value="${slot.id_slot}">
                                <button type="submit" class="btn btn-sm btn-primary px-3">Prenota</button>
                            </form>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            containerOrari.innerHTML = html;
        }

        function renderCalendarioIstruttore(idIstruttore, nomeIstruttore, tariffaIstruttore) {
            tariffaCorrente = tariffaIstruttore || 'Su richiesta';
            if (labelIstruttore) {
                labelIstruttore.textContent = nomeIstruttore;
            }
            if (labelTariffa) {
                labelTariffa.textContent = tariffaCorrente !== 'Su richiesta'
                    ? tariffaCorrente + ' / ora'
                    : 'Tariffa su richiesta';
            }
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
                btn.className = 'btn btn-sm btn-giorno-cal text-start' + (index === 0 ? ' active' : '');
                btn.innerHTML = `<small class="d-block opacity-75">${giorno.giorno_settimana}</small><strong>${giorno.data_label}</strong>`;
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.btn-giorno-cal').forEach(function (b) { b.classList.remove('active'); });
                    btn.classList.add('active');
                    renderOrariGiorno(giorno);
                });
                containerGiorni.appendChild(btn);
            });

            renderOrariGiorno(giorni[0]);
        }

        bottoniIstruttori.forEach(function (btn) {
            btn.addEventListener('click', function () {
                bottoniIstruttori.forEach(function (b) { b.classList.remove('active'); });
                btn.classList.add('active');
                renderCalendarioIstruttore(
                    btn.getAttribute('data-istruttore-id'),
                    btn.getAttribute('data-istruttore-nome'),
                    btn.getAttribute('data-istruttore-tariffa')
                );
            });
        });

        if (bottoniIstruttori.length > 0) {
            const primo = bottoniIstruttori[0];
            renderCalendarioIstruttore(
                primo.getAttribute('data-istruttore-id'),
                primo.getAttribute('data-istruttore-nome'),
                primo.getAttribute('data-istruttore-tariffa')
            );
        }
    }

    /* 2. FILTRI RAPIDI CORSI DI GRUPPO */
    const grid = document.getElementById('calendarGrid');
    const filtersContainer = document.getElementById('calendarFilters');
    const countBadge = document.getElementById('calendarCountBadge');

    if (grid && filtersContainer) {
        const cards = Array.from(grid.querySelectorAll('.calendar-lesson-col'));
        const corsi = Array.from(new Set(cards.map(function (c) {
            return c.getAttribute('data-corso') || '';
        }).filter(Boolean)));

        if (corsi.length >= 2) {
            function createBtn(label, value, isActive) {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'calendar-filter-btn' + (isActive ? ' active' : '');
                btn.textContent = label;
                btn.setAttribute('data-filter', value);
                return btn;
            }

            filtersContainer.appendChild(createBtn('Tutti i corsi', 'all', true));
            corsi.forEach(function (corso) {
                filtersContainer.appendChild(createBtn(corso, corso, false));
            });

            filtersContainer.addEventListener('click', function (event) {
                const target = event.target.closest('.calendar-filter-btn');
                if (!target) return;

                const selected = target.getAttribute('data-filter');

                filtersContainer.querySelectorAll('.calendar-filter-btn').forEach(function (btn) {
                    btn.classList.toggle('active', btn === target);
                });

                let visibleCount = 0;
                cards.forEach(function (card) {
                    const match = selected === 'all' || card.getAttribute('data-corso') === selected;
                    card.classList.toggle('d-none', !match);
                    if (match) visibleCount++;
                });

                if (countBadge) {
                    countBadge.textContent = visibleCount + (visibleCount === 1 ? ' lezione in programma' : ' lezioni in programma');
                }
            });
        } else {
            filtersContainer.classList.add('d-none');
        }
    }
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
