<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:32:30
  from 'file:admin_utenti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085f1ea1ce69_30223805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b473fb0f5cd8d42375dfafe67d193a650202efe4' => 
    array (
      0 => 'admin_utenti.tpl',
      1 => 1795710684,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085f1ea1ce69_30223805 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utenti.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16863651316b085f1e9f51e3_92943109', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_16863651316b085f1e9f51e3_92943109 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno alla Dashboard -->
    <div class="mb-3">
        <a href="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('label_dashboard') ?? null)===null||$tmp==='' ? 'Pannello' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('badge_sezione') ?? null)===null||$tmp==='' ? 'Anagrafica Studio' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
                <h1 class="dashboard-title"><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('titolo_sezione') ?? null)===null||$tmp==='' ? 'Gestione Utenti' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</h1>
                <p class="dashboard-subtitle">
                    <?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('sottotitolo_sezione') ?? null)===null||$tmp==='' ? 'Visualizza e aggiorna i profili registrati.' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>

                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=creaUtente" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('label_nuovo') ?? null)===null||$tmp==='' ? 'Nuovo Utente' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</span>
                </a>
            </div>
        </div>
    </section>

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

    <!-- Tabella Utenti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Profili</h2>
            <span class="dashboard-count-badge">
                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('utenti'));?>
 <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('utenti')) == 1) {?>profilo<?php } else { ?>profili<?php }?>
            </span>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('utenti') || empty($_smarty_tpl->getValue('utenti')))) {?>
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun profilo presente</p>
                <p class="dashboard-empty-text">Non risultano ancora profili registrati in questa sezione.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Data di nascita</th>
                            <th>Ruolo</th>
                            <?php if (!( !$_smarty_tpl->hasVariable('mostra_colonne_allievo') || empty($_smarty_tpl->getValue('mostra_colonne_allievo')))) {?>
                                <th>Crediti</th>
                                <th>Scadenza Certificato</th>
                            <?php } else { ?>
                                <th>Tariffa 1-to-1</th>
                            <?php }?>
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('utenti'), 'u');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('u')->value) {
$foreach2DoElse = false;
?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="admin-avatar-sm">
                                            <?php if ($_smarty_tpl->getValue('u')->getImmagineProfilo()) {?>
                                                <img src="/studio-essenza/<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getImmagineProfilo(), ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
">
                                            <?php } else { ?>
                                                <?php echo mb_strtoupper((string) substr((string) $_smarty_tpl->getValue('u')->getNome(), (int) 0, (int) 1) ?? '', 'UTF-8');
echo mb_strtoupper((string) substr((string) $_smarty_tpl->getValue('u')->getCognome(), (int) 0, (int) 1) ?? '', 'UTF-8');?>

                                            <?php }?>
                                        </span>
                                        <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getTelefono() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getDataNascitaFormattata() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td>
                                    <span class="admin-role-pill is-<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getRuolo(), ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getRuolo(), ENT_QUOTES, 'UTF-8', true);?>

                                    </span>
                                </td>
                                <?php if (!( !$_smarty_tpl->hasVariable('mostra_colonne_allievo') || empty($_smarty_tpl->getValue('mostra_colonne_allievo')))) {?>
                                    <td>
                                        <?php if ($_smarty_tpl->getValue('u')->getRuolo() == 'allievo') {?>
                                            <strong><?php echo $_smarty_tpl->getValue('u')->getCreditiResidui();?>
</strong>
                                        <?php } else { ?>
                                            <span class="text-muted small">&mdash;</span>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($_smarty_tpl->getValue('u')->getRuolo() == 'allievo') {?>
                                            <?php if ($_smarty_tpl->getValue('u')->getScadenzaCertificato()) {?>
                                                <?php if ($_smarty_tpl->getValue('u')->haCertificatoValido()) {?>
                                                    <span class="dashboard-status-pill is-confirmed">
                                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getScadenzaCertificatoFormattata(), ENT_QUOTES, 'UTF-8', true);?>

                                                    </span>
                                                <?php } else { ?>
                                                    <span class="dashboard-status-pill is-cancelled">
                                                        Scaduto (<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getScadenzaCertificatoFormattata(), ENT_QUOTES, 'UTF-8', true);?>
)
                                                    </span>
                                                <?php }?>
                                            <?php } else { ?>
                                                <span class="text-muted small">Non presente</span>
                                            <?php }?>
                                        <?php } else { ?>
                                            <span class="text-muted small">&mdash;</span>
                                        <?php }?>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                        <?php if ($_smarty_tpl->getValue('u')->getRuolo() == 'istruttore') {?>
                                            <?php if ($_smarty_tpl->getValue('u')->getTariffaFormattata()) {?>
                                                <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getTariffaFormattata(), ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                            <?php } else { ?>
                                                <span class="text-muted small">Su richiesta</span>
                                            <?php }?>
                                        <?php } else { ?>
                                            <span class="text-muted small">&mdash;</span>
                                        <?php }?>
                                    </td>
                                <?php }?>
                                <td class="text-end text-nowrap">
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-outline-essenza me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDettaglioUtente"
                                        data-nome="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-cognome="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-iniziali="<?php echo mb_strtoupper((string) substr((string) $_smarty_tpl->getValue('u')->getNome(), (int) 0, (int) 1) ?? '', 'UTF-8');
echo mb_strtoupper((string) substr((string) $_smarty_tpl->getValue('u')->getCognome(), (int) 0, (int) 1) ?? '', 'UTF-8');?>
"
                                        data-email="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getEmail(), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-telefono="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getTelefono() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-nascita="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getDataNascitaFormattata() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-registrazione="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getDataRegistrazioneFormattata() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-ruolo="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getRuolo(), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-crediti="<?php echo $_smarty_tpl->getValue('u')->getCreditiResidui();?>
"
                                        data-certificato="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getScadenzaCertificatoFormattata() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-certificato-valido="<?php if ($_smarty_tpl->getValue('u')->haCertificatoValido()) {?>1<?php } else { ?>0<?php }?>"
                                        data-tariffa="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getTariffaFormattata() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-descrizione="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getDescrizione() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                        data-immagine="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('u')->getImmagineProfilo() ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
                                    >
                                        Dettagli
                                    </button>
                                    <a href="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=modificaUtente&id=<?php echo $_smarty_tpl->getValue('u')->getId();?>
" class="btn btn-sm btn-primary">
                                        Modifica
                                    </a>
                                </td>
                            </tr>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php }?>
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


<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
