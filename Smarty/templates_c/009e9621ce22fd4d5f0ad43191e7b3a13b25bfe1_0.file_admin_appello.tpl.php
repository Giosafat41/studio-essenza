<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:23:26
  from 'file:admin_appello.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085cfe6a2846_59060197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '009e9621ce22fd4d5f0ad43191e7b3a13b25bfe1' => 
    array (
      0 => 'admin_appello.tpl',
      1 => 1795710130,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085cfe6a2846_59060197 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_appello.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8941115016b085cfe68d845_80879064', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_8941115016b085cfe68d845_80879064 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container dashboard-page py-2 py-md-3">

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

    <!-- Intestazione Lezione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Gestione Lezione &amp; Appello</span>
                <h1 class="dashboard-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['nome_corso'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
                <p class="dashboard-subtitle">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['data'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['orario'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; Istruttore: <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['istruttore'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                </p>
            </div>

            <div class="d-flex flex-column align-items-lg-end gap-2">
                <div class="calendar-status-group">
                    <div class="calendar-crediti-pill">
                        <span class="calendar-crediti-label">Iscritti</span>
                        <div class="calendar-crediti-valore">
                            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('iscritti'));?>
 <small>/ <?php echo $_smarty_tpl->getValue('lezione')['capienza_max'];?>
 posti</small>
                        </div>
                    </div>
                </div>
                <?php if (!( !$_smarty_tpl->hasVariable('puo_eliminare_lezione') || empty($_smarty_tpl->getValue('puo_eliminare_lezione')))) {?>
                    <form
                        action="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=eliminaLezione"
                        method="POST"
                        class="m-0"
                        onsubmit="return confirm('Vuoi davvero eliminare questa lezione? Eventuali allievi iscritti riceveranno il rimborso di 1 credito.');"
                    >
                        <input type="hidden" name="id_lezione" value="<?php echo $_smarty_tpl->getValue('lezione')['id'];?>
">
                        <button type="submit" class="btn btn-sm btn-disdici">Elimina Lezione</button>
                    </form>
                <?php }?>
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

    <!-- Cambio Istruttore -->
    <?php if (!( !$_smarty_tpl->hasVariable('istruttori') || empty($_smarty_tpl->getValue('istruttori')))) {?>
        <section class="dashboard-card mb-4">
            <h2 class="dashboard-section-title mb-3">Cambia Istruttore Assegnato</h2>
            <form
                action="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=cambiaIstruttoreLezione"
                method="POST"
                class="row g-3 align-items-end"
            >
                <input type="hidden" name="id_lezione" value="<?php echo $_smarty_tpl->getValue('lezione')['id'];?>
">
                <div class="col-12 col-md-8">
                    <label for="id_istruttore" class="form-label auth-label">Istruttore per questa lezione</label>
                    <select id="id_istruttore" name="id_istruttore" class="form-select admin-select" required data-msg-required="Seleziona un istruttore dal menù a tendina.">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach2DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('istr')->getId();?>
" <?php if ($_smarty_tpl->getValue('istr')->getId() == $_smarty_tpl->getValue('lezione')['id_istruttore']) {?>selected<?php }?>>
                                <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>

                            </option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-primary admin-action-btn w-100">
                        Aggiorna Istruttore
                    </button>
                </div>
            </form>
        </section>
    <?php }?>

    <!-- Elenco Iscritti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Allievi Prenotati</h2>
            <span class="dashboard-count-badge">
                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('iscritti'));?>
 <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('iscritti')) == 1) {?>partecipante<?php } else { ?>partecipanti<?php }?>
            </span>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('iscritti') || empty($_smarty_tpl->getValue('iscritti')))) {?>
            <div class="dashboard-empty">
                <div class="dashboard-empty-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="17" y1="8" x2="23" y2="14"></line>
                        <line x1="23" y1="8" x2="17" y2="14"></line>
                    </svg>
                </div>
                <p class="dashboard-empty-title">Nessun allievo prenotato</p>
                <p class="dashboard-empty-text">
                    Al momento non risultano prenotazioni confermate per questa lezione.
                </p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Allievo</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Certificato Medico</th>
                            <th class="text-end">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('iscritti'), 'allievo');
$_smarty_tpl->getVariable('allievo')->iteration = 0;
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allievo')->value) {
$foreach3DoElse = false;
$_smarty_tpl->getVariable('allievo')->iteration++;
$foreach3Backup = clone $_smarty_tpl->getVariable('allievo');
?>
                            <tr>
                                <td class="text-muted"><?php echo $_smarty_tpl->getVariable('allievo')->iteration;?>
</td>
                                <td><strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allievo')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allievo')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</strong></td>
                                <td><?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('allievo')['telefono'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('allievo')['email'], ENT_QUOTES, 'UTF-8', true);?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->getValue('allievo')['certificato_valido']) {?>
                                        <span class="dashboard-status-pill is-confirmed">Valido</span>
                                    <?php } else { ?>
                                        <span class="dashboard-status-pill is-cancelled">Scaduto / Assente</span>
                                    <?php }?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <form
                                        action="index.php?controller=<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('controller_base') ?? null)===null||$tmp==='' ? 'admin' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
&action=disiscriviAllievo"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Vuoi disiscrivere <?php echo strtr((string)$_smarty_tpl->getValue('allievo')['nome'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
						"\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
						"`" => "\\`", "\${" => "\\\$\{"));?>
 <?php echo strtr((string)$_smarty_tpl->getValue('allievo')['cognome'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
						"\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
						"`" => "\\`", "\${" => "\\\$\{"));?>
 da questa lezione? Verrà rimborsato 1 credito.');"
                                    >
                                        <input type="hidden" name="id_lezione" value="<?php echo $_smarty_tpl->getValue('lezione')['id'];?>
">
                                        <input type="hidden" name="id_prenotazione" value="<?php echo $_smarty_tpl->getValue('allievo')['id_prenotazione'];?>
">
                                        <button type="submit" class="btn btn-sm btn-disdici">Disiscrivi</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
$_smarty_tpl->setVariable('allievo', $foreach3Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php }?>
    </section>

</div>
<?php
}
}
/* {/block "content"} */
}
