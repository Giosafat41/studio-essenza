<?php
/* Smarty version 5.8.5, created on 2026-11-24 17:20:01
  from 'file:admin_utenti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b05b931ca3074_30358954',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b473fb0f5cd8d42375dfafe67d193a650202efe4' => 
    array (
      0 => 'admin_utenti.tpl',
      1 => 1795535476,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b05b931ca3074_30358954 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utenti.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19690962906b05b931c89b86_18947414', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_19690962906b05b931c89b86_18947414 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-wide-page py-2 py-md-3">

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

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Anagrafica Studio</span>
                <h1 class="dashboard-title">Gestione Utenti</h1>
                <p class="dashboard-subtitle">
                    Visualizza e aggiorna i dati completi, il saldo crediti e il certificato medico degli iscritti.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=admin&action=creaUtente" class="btn btn-primary dashboard-cta-btn w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    <span>Nuovo Utente</span>
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

    <!-- Tabella Utenti -->
    <section class="dashboard-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
            <h2 class="dashboard-section-title">Elenco Profili Registrati</h2>
            <span class="dashboard-count-badge">
                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('utenti'));?>
 <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('utenti')) == 1) {?>utente<?php } else { ?>utenti<?php }?>
            </span>
        </div>

        <?php if (( !$_smarty_tpl->hasVariable('utenti') || empty($_smarty_tpl->getValue('utenti')))) {?>
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Nessun utente registrato</p>
                <p class="dashboard-empty-text">Non risultano ancora utenti presenti nel sistema.</p>
            </div>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nome e Cognome</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Ruolo</th>
                            <th>Crediti</th>
                            <th>Scadenza Certificato</th>
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
                                <td>
                                    <span class="admin-role-pill is-<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getRuolo(), ENT_QUOTES, 'UTF-8', true);?>
">
                                        <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('u')->getRuolo(), ENT_QUOTES, 'UTF-8', true);?>

                                    </span>
                                </td>
                                <td><strong><?php echo $_smarty_tpl->getValue('u')->getCreditiResidui();?>
</strong></td>
                                <td>
                                    <?php if ($_smarty_tpl->getValue('u')->getScadenzaCertificato()) {?>
                                        <?php if ($_smarty_tpl->getValue('u')->haCertificatoValido()) {?>
                                            <span class="dashboard-status-pill is-confirmed">
                                                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('u')->getScadenzaCertificato(),"%d/%m/%Y");?>

                                            </span>
                                        <?php } else { ?>
                                            <span class="dashboard-status-pill is-cancelled">
                                                Scaduto (<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('u')->getScadenzaCertificato(),"%d/%m/%Y");?>
)
                                            </span>
                                        <?php }?>
                                    <?php } else { ?>
                                        <span class="text-muted small">Non presente</span>
                                    <?php }?>
                                </td>
                                <td class="text-end text-nowrap">
                                    <a href="index.php?controller=admin&action=modificaUtente&id=<?php echo $_smarty_tpl->getValue('u')->getId();?>
" class="btn btn-sm btn-outline-essenza">
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
<?php
}
}
/* {/block "content"} */
}
