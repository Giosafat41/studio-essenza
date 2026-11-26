<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:41:33
  from 'file:istruttore_dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b08613d169931_99121553',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c6721a054fb4f0c0a1fd302f4427c2e5bd1ae8c' => 
    array (
      0 => 'istruttore_dashboard.tpl',
      1 => 1795710162,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b08613d169931_99121553 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/istruttore_dashboard.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10259825996b08613d121991_82562542', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_10259825996b08613d121991_82562542 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container my-4">

    <!-- Intestazione -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar">
                    <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                        <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('immagine_profilo'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cognome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
">
                    <?php } else { ?>
                        <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('iniziali_istruttore') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                    <?php }?>
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
                <p class="text-muted mb-0">Benvenuto/a, <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cognome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
</strong> &bull; <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('email_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
</p>
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
    <?php if (!( !$_smarty_tpl->hasVariable('mostra_avviso_password') || empty($_smarty_tpl->getValue('mostra_avviso_password')))) {?>
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
    <?php }?>

    <!-- Messaggi di conferma / errore -->
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <?php echo $_smarty_tpl->getValue('messaggio_successo');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <?php echo $_smarty_tpl->getValue('messaggio_errore');?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>

    <!-- Riepilogo Numerico Rapido -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold" style="color: #7b8b6f;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('corsi_futuri'));?>
</div>
                <div class="text-muted small">Corsi di gruppo in programma</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold text-success"><?php echo $_smarty_tpl->getValue('conteggio_prenotate');?>
</div>
                <div class="text-muted small">Lezioni individuali prenotate</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="bg-white rounded-3 shadow-sm p-3 text-center h-100">
                <div class="fs-2 fw-bold text-secondary"><?php echo $_smarty_tpl->getValue('conteggio_disponibili');?>
</div>
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
                        <?php if (!( !$_smarty_tpl->hasVariable('tariffa_formattata') || empty($_smarty_tpl->getValue('tariffa_formattata')))) {?>
                            <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('tariffa_formattata'), ENT_QUOTES, 'UTF-8', true);?>
 / ora
                        <?php } else { ?>
                            Da impostare
                        <?php }?>
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
                                value="<?php if ($_smarty_tpl->getValue('tariffa_individuale') !== null) {
echo $_smarty_tpl->getValue('tariffa_individuale');
}?>"
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
                            min="<?php echo $_smarty_tpl->getValue('oggi_input');?>
"
                            required
                            data-msg-required="Seleziona una data per la disponibilità."
                            data-msg-min="Non puoi selezionare una data già trascorsa."
                        >
                    </div>

                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label for="ora_inizio" class="form-label fw-semibold">Dalle</label>
                            <select id="ora_inizio" name="ora_inizio" class="form-select" required data-msg-required="Seleziona l'orario di inizio.">
                                <?php
$_smarty_tpl->tpl_vars['__smarty_section_h'] = new \Smarty\Variable(array());
if (true) {
for ($__section_h_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_h']->value['index'] = 8; $__section_h_0_iteration <= 13; $__section_h_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_h']->value['index']++){
?>
                                    <option value="<?php echo ($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null);?>
">
                                        <?php if (($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null) < 10) {?>0<?php }
echo ($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null);?>
:00
                                    </option>
                                <?php
}
}
?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="ora_fine" class="form-label fw-semibold">Alle</label>
                            <select id="ora_fine" name="ora_fine" class="form-select" required data-msg-required="Seleziona l'orario di fine." data-gt-target="ora_inizio" data-msg-gt="L'orario di fine deve essere successivo a quello di inizio.">
                                <?php
$_smarty_tpl->tpl_vars['__smarty_section_h'] = new \Smarty\Variable(array());
if (true) {
for ($__section_h_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_h']->value['index'] = 9; $__section_h_0_iteration <= 13; $__section_h_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_h']->value['index']++){
?>
                                    <option value="<?php echo ($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null);?>
" <?php if (($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null) == 11) {?>selected<?php }?>>
                                        <?php if (($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null) < 10) {?>0<?php }
echo ($_smarty_tpl->getValue('__smarty_section_h')['index'] ?? null);?>
:00
                                    </option>
                                <?php
}
}
?>
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

                <?php if (( !$_smarty_tpl->hasVariable('lezioni_individuali') || empty($_smarty_tpl->getValue('lezioni_individuali')))) {?>
                    <p class="text-muted mb-0">Non hai ancora inserito disponibilità future. Usa il modulo a sinistra per aprire nuovi slot orari.</p>
                <?php } else { ?>
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
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('lezioni_individuali'), 'slot');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('slot')->value) {
$foreach1DoElse = false;
?>
                                    <tr>
                                        <td class="text-nowrap">
                                            <strong><?php echo $_smarty_tpl->getValue('slot')['data_formattata'];?>
</strong><br>
                                            <small class="text-muted"><?php echo $_smarty_tpl->getValue('slot')['ora_inizio'];?>
 - <?php echo $_smarty_tpl->getValue('slot')['ora_fine'];?>
</small>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->getValue('slot')['stato'] == 'prenotata') {?>
                                                <span class="badge bg-success">Prenotata</span>
                                            <?php } elseif ($_smarty_tpl->getValue('slot')['stato'] == 'disponibile') {?>
                                                <span class="badge bg-secondary">Disponibile</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Annullata</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->getValue('slot')['stato'] == 'prenotata') {?>
                                                <strong><?php echo $_smarty_tpl->getValue('slot')['allievo_nome'];?>
</strong><br>
                                                <small class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('slot')['allievo_telefono'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('slot')['allievo_email'] ?? null : $tmp);?>
</small>
                                            <?php } elseif ($_smarty_tpl->getValue('slot')['stato'] == 'annullata_istruttore') {?>
                                                <span class="text-muted small">Allievo: <?php echo (($tmp = $_smarty_tpl->getValue('slot')['allievo_nome'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</span><br>
                                                <small class="text-danger"><strong>Motivo:</strong> <?php echo $_smarty_tpl->getValue('slot')['motivazione'];?>
</small>
                                            <?php } else { ?>
                                                <span class="text-muted small">In attesa di prenotazione</span>
                                            <?php }?>
                                        </td>
                                        <td class="text-end text-nowrap">
                                            <?php if ($_smarty_tpl->getValue('slot')['stato'] == 'disponibile') {?>
                                                <form action="index.php?controller=istruttore&action=rimuoviDisponibilita" method="POST" class="d-inline">
                                                    <input type="hidden" name="id_slot" value="<?php echo $_smarty_tpl->getValue('slot')['id'];?>
">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Rimuovi</button>
                                                </form>
                                            <?php } elseif ($_smarty_tpl->getValue('slot')['stato'] == 'prenotata') {?>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalAnnullaIndividuale"
                                                        data-id="<?php echo $_smarty_tpl->getValue('slot')['id'];?>
"
                                                        data-dettagli="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('slot')['allievo_nome'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo $_smarty_tpl->getValue('slot')['data_formattata'];?>
 <?php echo $_smarty_tpl->getValue('slot')['ora_inizio'];?>
-<?php echo $_smarty_tpl->getValue('slot')['ora_fine'];?>
)">
                                                    Annulla
                                                </button>
                                            <?php } else { ?>
                                                <span class="text-muted small">&mdash;</span>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>
            </div>
        </div>

    </div>

    <!-- SEZIONE 2: CORSI DI GRUPPO ASSEGNATI DALL'ADMIN -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h2 class="h5 pb-2 mb-3 border-bottom" style="color: #7b8b6f;">Corsi di Gruppo Assegnati</h2>

        <?php if (( !$_smarty_tpl->hasVariable('corsi_futuri') || empty($_smarty_tpl->getValue('corsi_futuri')))) {?>
            <p class="text-muted mb-0">Non risultano corsi di gruppo in programma assegnati al tuo profilo.</p>
        <?php } else { ?>
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
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi_futuri'), 'corso');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach2DoElse = false;
?>
                            <tr>
                                <td><strong><?php echo $_smarty_tpl->getValue('corso')['nome_corso'];?>
</strong></td>
                                <td><?php echo $_smarty_tpl->getValue('corso')['data_formattata'];?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('corso')['ora_inizio'];?>
 - <?php echo $_smarty_tpl->getValue('corso')['ora_fine'];?>
</td>
                                <td>
                                    <span class="badge rounded-pill" style="background-color: #eef1ec; color: #5f6e54;">
                                        <?php echo $_smarty_tpl->getValue('corso')['num_iscritti'];?>
 / <?php echo $_smarty_tpl->getValue('corso')['capienza_max'];?>
 posti
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="index.php?controller=istruttore&action=appello&id_lezione=<?php echo $_smarty_tpl->getValue('corso')['id_lezione'];?>
" class="btn btn-sm btn-primary">Apri Appello</a>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php }?>
    </div>

    <!-- Storico Corsi Svolti (se presenti) -->
    <?php if (!( !$_smarty_tpl->hasVariable('corsi_passati') || empty($_smarty_tpl->getValue('corsi_passati')))) {?>
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
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi_passati'), 'corso');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach3DoElse = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getValue('corso')['nome_corso'];?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('corso')['data_formattata'];?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('corso')['ora_inizio'];?>
 - <?php echo $_smarty_tpl->getValue('corso')['ora_fine'];?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('corso')['num_iscritti'];?>
 / <?php echo $_smarty_tpl->getValue('corso')['capienza_max'];?>
</td>
                                <td class="text-end">
                                    <a href="index.php?controller=istruttore&action=appello&id_lezione=<?php echo $_smarty_tpl->getValue('corso')['id_lezione'];?>
" class="text-decoration-none fw-semibold" style="color: #7b8b6f;">Vedi elenco</a>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php }?>

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
                        <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                            <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('immagine_profilo'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('cognome_istruttore'), ENT_QUOTES, 'UTF-8', true);?>
">
                        <?php } else { ?>
                            <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('iniziali_istruttore') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                        <?php }?>
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

                <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                    <hr class="auth-divider my-3">
                    <form action="index.php?controller=istruttore&action=rimuoviImmagineProfilo" method="POST" class="text-center" onsubmit="return confirm('Vuoi davvero rimuovere la tua immagine profilo?');">
                        <button type="submit" class="btn btn-sm btn-disdici">Rimuovi immagine attuale</button>
                    </form>
                <?php }?>
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
