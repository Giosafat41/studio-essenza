<?php
/* Smarty version 5.8.5, created on 2026-11-24 16:33:32
  from 'file:admin_appello.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b05ae4c4626c2_13767677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '009e9621ce22fd4d5f0ad43191e7b3a13b25bfe1' => 
    array (
      0 => 'admin_appello.tpl',
      1 => 1795534389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b05ae4c4626c2_13767677 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_appello.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6937966556b05ae4c458b21_94186926', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_6937966556b05ae4c458b21_94186926 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container dashboard-page py-2 py-md-3">

    <!-- Link ritorno al Pannello Segreteria -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al Pannello Segreteria</span>
        </a>
    </div>

    <!-- Intestazione Lezione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Registro Appello</span>
                <h1 class="dashboard-title"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['nome_corso'], ENT_QUOTES, 'UTF-8', true);?>
</h1>
                <p class="dashboard-subtitle">
                    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['data'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['orario'], ENT_QUOTES, 'UTF-8', true);?>
 &bull; Istruttore: <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('lezione')['istruttore'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                </p>
            </div>

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
        </div>
    </section>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('iscritti'), 'allievo');
$_smarty_tpl->getVariable('allievo')->iteration = 0;
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allievo')->value) {
$foreach1DoElse = false;
$_smarty_tpl->getVariable('allievo')->iteration++;
$foreach1Backup = clone $_smarty_tpl->getVariable('allievo');
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
                            </tr>
                        <?php
$_smarty_tpl->setVariable('allievo', $foreach1Backup);
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
