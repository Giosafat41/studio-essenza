<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:26:46
  from 'file:errore.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6426cda938_73733128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec8b31e9684b6fc18b7e2ab818ec28ead0a94bab' => 
    array (
      0 => 'errore.tpl',
      1 => 1794925509,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6426cda938_73733128 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/errore.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20902738066afc6426cd7747_16628821', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_20902738066afc6426cd7747_16628821 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="form-container" style="text-align: center;">
    <h2>Ops, qualcosa è andato storto!</h2>
    <div class="alert-error" style="margin: 20px 0;">
        <?php echo $_smarty_tpl->getValue('errore');?>

    </div>
    <a href="index.php?controller=utente&action=dashboard" class="btn-primary">Torna alla tua Dashboard</a>
</div>
<?php
}
}
/* {/block "content"} */
}
