<?php
/* Smarty version 5.8.5, created on 2026-11-19 19:07:31
  from 'file:errore.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aff3ae37e1b75_27128854',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec8b31e9684b6fc18b7e2ab818ec28ead0a94bab' => 
    array (
      0 => 'errore.tpl',
      1 => 1795111373,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aff3ae37e1b75_27128854 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/errore.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3634398966aff3ae37d8cb3_40778751', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_3634398966aff3ae37d8cb3_40778751 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<section class="auth-section">
    <div class="auth-card text-center">

        <div class="error-state-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>

        <h1 class="auth-title">Operazione non completata</h1>

        <div class="auth-alert-error text-start my-4" role="alert">
            <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('errore'), ENT_QUOTES, 'UTF-8', true);?>

        </div>

        <div class="d-flex flex-column gap-2">
            <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary auth-submit-btn w-100">
                Torna al Calendario
            </a>
            <a href="index.php?controller=utente&action=dashboard" class="auth-link mt-2">
                Vai alla tua Dashboard
            </a>
        </div>

    </div>
</section>
<?php
}
}
/* {/block "content"} */
}
