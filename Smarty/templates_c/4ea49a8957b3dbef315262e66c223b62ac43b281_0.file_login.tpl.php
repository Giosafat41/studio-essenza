<?php
/* Smarty version 5.8.5, created on 2026-11-11 12:33:28
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6af452882b6863_46992158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ea49a8957b3dbef315262e66c223b62ac43b281' => 
    array (
      0 => 'login.tpl',
      1 => 1794396530,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af452882b6863_46992158 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/login.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1217067526af452882ab256_05178036', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1217067526af452882ab256_05178036 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="form-container">
    <h2>Accedi al tuo profilo</h2>
    
    <!-- Se il Controller passa un errore, Smarty lo mostra qui -->
    <?php if ((true && ($_smarty_tpl->hasVariable('errore') && null !== ($_smarty_tpl->getValue('errore') ?? null)))) {?>
        <div class="alert-error"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <form action="index.php?controller=utente&action=login" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Inserisci la tua email">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Inserisci la tua password">
        </div>
        
        <button type="submit" class="btn-primary">Accedi</button>
    </form>
    
    <p class="form-footer">Non hai ancora un account? <a href="index.php?controller=utente&action=registra">Registrati qui</a>.</p>
</div>
<?php
}
}
/* {/block "content"} */
}
