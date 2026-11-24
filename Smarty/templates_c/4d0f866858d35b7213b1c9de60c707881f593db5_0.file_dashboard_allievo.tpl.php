<?php
/* Smarty version 5.8.5, created on 2026-11-24 17:35:45
  from 'file:dashboard_allievo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b05bce1610cc6_60022757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d0f866858d35b7213b1c9de60c707881f593db5' => 
    array (
      0 => 'dashboard_allievo.tpl',
      1 => 1795537819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b05bce1610cc6_60022757 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/dashboard_allievo.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7047741016b05bce15fbe86_23480986', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_7047741016b05bce15fbe86_23480986 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container dashboard-page py-2 py-md-3">

    <!-- Intestazione Benvenuto + CTA Principale -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="profile-avatar-wrap">
                    <div class="profile-avatar">
                        <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                            <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('immagine_profilo'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_utente'), ENT_QUOTES, 'UTF-8', true);?>
">
                        <?php } else { ?>
                            <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('iniziali_utente') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                        <?php }?>
                    </div>
                    <button
                        type="button"
                        class="profile-avatar-edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#modalFotoProfiloAllievo"
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
                    <span class="auth-badge mb-2">Area Allievo</span>
                    <h1 class="dashboard-title">Bentornato/a, <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_utente'), ENT_QUOTES, 'UTF-8', true);?>
!</h1>
                    <p class="dashboard-subtitle">
                        Gestisci il tuo saldo crediti, i corsi di gruppo e le lezioni individuali in Studio Essenza.
                    </p>
                </div>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <line x1="12" y1="14" x2="12" y2="18"></line>
                        <line x1="10" y1="16" x2="14" y2="16"></line>
                    </svg>
                    <span>Prenota una lezione</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Messaggi di conferma / errore -->
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div class="alert auth-alert-success fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_successo'), ENT_QUOTES, 'UTF-8', true);?>
</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
        <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_errore'), ENT_QUOTES, 'UTF-8', true);?>
</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>

    <!-- Griglia Contenuti: Saldo Crediti + Lezioni -->
    <div class="row g-4 align-items-start">

        <!-- Colonna Sinistra: Saldo Crediti -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card">
                <h2 class="dashboard-saldo-label">Il tuo Saldo Attuale</h2>

                <div class="dashboard-saldo-box mb-3">
                    <div class="dashboard-crediti-numero"><?php echo $_smarty_tpl->getValue('crediti');?>
</div>
                    <p class="dashboard-crediti-unita">
                        <?php if ($_smarty_tpl->getValue('crediti') == 1) {?>
                            lezione disponibile
                        <?php } else { ?>
                            lezioni disponibili
                        <?php }?>
                    </p>
                </div>

                <?php if ($_smarty_tpl->getValue('avviso_crediti')) {?>
                    <div class="dashboard-avviso-rinnovo d-flex align-items-start gap-2 mb-3" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <div>
                            <strong>Ingressi in esaurimento:</strong> ricordati di passare in segreteria per rinnovare il tuo pacchetto.
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="dashboard-saldo-ok mb-3">
                        Il tuo pacchetto è attivo. Puoi prenotare i corsi di gruppo dal calendario (le lezioni 1-to-1 sono pagate a parte).
                    </div>
                <?php }?>

                <div class="auth-support-note">
                    Vuoi aggiungere nuovi ingressi?
                    <a href="index.php?controller=info&action=tariffe">Consulta le tariffe</a>
                </div>
            </section>
        </div>

        <!-- Colonna Destra: Lezioni Individuali + Corsi di Gruppo -->
        <div class="col-12 col-lg-8 d-flex flex-column gap-4">

            <!-- Sezione Lezioni Individuali (1-to-1) -->
            <section class="dashboard-card">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                    <h2 class="dashboard-section-title">Le tue Lezioni Individuali (1-to-1)</h2>
                    <span class="dashboard-count-badge">
                        <?php if (( !$_smarty_tpl->hasVariable('lezioni_individuali') || empty($_smarty_tpl->getValue('lezioni_individuali')))) {?>
                            0 lezioni
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('lezioni_individuali'));?>

                            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('lezioni_individuali')) == 1) {?>lezione<?php } else { ?>lezioni<?php }?>
                        <?php }?>
                    </span>
                </div>

                <?php if (( !$_smarty_tpl->hasVariable('lezioni_individuali') || empty($_smarty_tpl->getValue('lezioni_individuali')))) {?>
                    <div class="dashboard-empty">
                        <div class="dashboard-empty-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <p class="dashboard-empty-title">Nessuna lezione individuale</p>
                        <p class="dashboard-empty-text">
                            Non hai ancora prenotato una sessione 1-to-1 con un istruttore dedicato.
                        </p>
                    </div>
                <?php } else { ?>
                    <ul class="dashboard-prenotazioni-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('lezioni_individuali'), 'ind');
$foreach6DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ind')->value) {
$foreach6DoElse = false;
?>
                            <li class="dashboard-prenotazione-item <?php if ($_smarty_tpl->getValue('ind')['stato'] == 'annullata_istruttore') {?>is-cancelled<?php }?>">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="dashboard-lesson-icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                            <span class="dashboard-lesson-title mb-0">Istruttore: <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ind')['istruttore'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                            <?php if ($_smarty_tpl->getValue('ind')['stato'] == 'prenotata') {?>
                                                <span class="dashboard-status-pill is-confirmed">Prenotata</span>
                                            <?php } else { ?>
                                                <span class="dashboard-status-pill is-cancelled">Annullata dall'istruttore</span>
                                            <?php }?>
                                        </div>
                                        <div class="dashboard-lesson-date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span>
                                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ind')['data'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ind')['ora_inizio'], ENT_QUOTES, 'UTF-8', true);?>
 - <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ind')['ora_fine'], ENT_QUOTES, 'UTF-8', true);?>

                                                <?php if (!( !true || empty($_smarty_tpl->getValue('ind')['tariffa_formattata']))) {?>
                                                    &bull; <strong style="color: #5f6e54;"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('ind')['tariffa_formattata'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                                <?php }?>
                                            </span>
                                        </div>
                                        <?php if ($_smarty_tpl->getValue('ind')['stato'] == 'annullata_istruttore') {?>
                                            <div class="dashboard-cancel-reason">
                                                <strong class="text-danger">Motivazione:</strong> <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('ind')['motivazione'] ?? null)===null||$tmp==='' ? 'Nessuna motivazione specificata.' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                                            </div>
                                        <?php }?>
                                    </div>
                                </div>

                                <?php if ($_smarty_tpl->getValue('ind')['stato'] == 'prenotata') {?>
                                    <form
                                        action="index.php?controller=prenotazione&action=cancellaIndividuale"
                                        method="POST"
                                        class="m-0 flex-shrink-0"
                                        onsubmit="return confirm('Vuoi davvero disdire questa lezione individuale?');"
                                    >
                                        <input type="hidden" name="id_slot" value="<?php echo $_smarty_tpl->getValue('ind')['id'];?>
">
                                        <button type="submit" class="btn-disdici">Disdici</button>
                                    </form>
                                <?php }?>
                            </li>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php }?>
            </section>

            <!-- Sezione Corsi di Gruppo Prenotati -->
            <section class="dashboard-card">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                    <h2 class="dashboard-section-title">I tuoi Corsi di Gruppo Prenotati</h2>
                    <span class="dashboard-count-badge">
                        <?php if (( !$_smarty_tpl->hasVariable('mie_prenotazioni') || empty($_smarty_tpl->getValue('mie_prenotazioni')))) {?>
                            0 prenotazioni
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mie_prenotazioni'));?>

                            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mie_prenotazioni')) == 1) {?>prenotazione<?php } else { ?>prenotazioni<?php }?>
                        <?php }?>
                    </span>
                </div>

                <?php if (( !$_smarty_tpl->hasVariable('mie_prenotazioni') || empty($_smarty_tpl->getValue('mie_prenotazioni')))) {?>
                    <div class="dashboard-empty">
                        <div class="dashboard-empty-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <p class="dashboard-empty-title">Nessun corso di gruppo prenotato</p>
                        <p class="dashboard-empty-text mb-3">
                            Esplora il calendario della settimana per riservare il tuo posto in sala.
                        </p>
                        <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary px-4 py-2">
                            Vai al Calendario
                        </a>
                    </div>
                <?php } else { ?>
                    <ul class="dashboard-prenotazioni-list">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mie_prenotazioni'), 'pren');
$foreach7DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('pren')->value) {
$foreach7DoElse = false;
?>
                            <li class="dashboard-prenotazione-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="dashboard-lesson-icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="dashboard-lesson-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('pren')['nome_corso'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                        <div class="dashboard-lesson-date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('pren')['data_ora'], ENT_QUOTES, 'UTF-8', true);?>
</span>
                                        </div>
                                    </div>
                                </div>

                                <form
                                    action="index.php?controller=prenotazione&action=cancella"
                                    method="POST"
                                    class="m-0 flex-shrink-0"
                                    onsubmit="return confirm('Vuoi davvero disdire questa lezione? Il credito verrà restituito al tuo saldo.');"
                                >
                                    <input type="hidden" name="id_prenotazione" value="<?php echo $_smarty_tpl->getValue('pren')['id_prenotazione'];?>
">
                                    <button type="submit" class="btn-disdici">Disdici</button>
                                </form>
                            </li>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </ul>

                    <div class="auth-support-note mt-4">
                        Se disdici una prenotazione, 1 ingresso viene riaccreditato automaticamente sul tuo profilo.
                    </div>
                <?php }?>
            </section>

        </div>
    </div>
</div>

<!-- MODALE CARICAMENTO IMMAGINE PROFILO ALLIEVO -->
<div class="modal fade" id="modalFotoProfiloAllievo" tabindex="-1" aria-labelledby="modalFotoProfiloAllievoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="modalFotoProfiloAllievoLabel" style="color: #4a4a4a;">Immagine Profilo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="profile-avatar-preview mx-auto" id="previewFotoAllievo">
                        <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                            <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('immagine_profilo'), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('nome_utente'), ENT_QUOTES, 'UTF-8', true);?>
">
                        <?php } else { ?>
                            <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('iniziali_utente') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                        <?php }?>
                    </div>
                </div>

                <form action="index.php?controller=utente&action=aggiornaImmagineProfilo" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inputFotoAllievo" class="form-label auth-label">Scegli una nuova immagine</label>
                        <input
                            type="file"
                            id="inputFotoAllievo"
                            name="immagine_profilo"
                            class="form-control admin-input"
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            required
                        >
                        <div class="form-text mt-1">Formati consentiti: JPG, PNG, WEBP, GIF (max 5 MB).</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-essenza" data-bs-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva Immagine</button>
                    </div>
                </form>

                <?php if (!( !$_smarty_tpl->hasVariable('immagine_profilo') || empty($_smarty_tpl->getValue('immagine_profilo')))) {?>
                    <hr class="auth-divider my-3">
                    <form action="index.php?controller=utente&action=rimuoviImmagineProfilo" method="POST" class="text-center" onsubmit="return confirm('Vuoi davvero rimuovere la tua immagine profilo?');">
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
    const input = document.getElementById('inputFotoAllievo');
    const preview = document.getElementById('previewFotoAllievo');
    if (!input || !preview) return;
    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Anteprima immagine profilo">';
        };
        reader.readAsDataURL(file);
    });
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
