<?php
/* Smarty version 5.8.5, created on 2026-11-11 12:32:36
  from 'file:registrazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6af45254d7d122_84091833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f48a0ebbae95f624db7e5c0893a097bae2d5f41e' => 
    array (
      0 => 'registrazione.tpl',
      1 => 1794396568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af45254d7d122_84091833 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/registrazione.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10224511446af45254d77ea0_00179891', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_10224511446af45254d77ea0_00179891 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="form-container">
    <h2>Nuovo Allievo</h2>
    <p class="sottotitolo">Crea un account per gestire le tue prenotazioni.</p>
    
    <?php if ((true && ($_smarty_tpl->hasVariable('errore') && null !== ($_smarty_tpl->getValue('errore') ?? null)))) {?>
        <div class="alert-error"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <form action="index.php?controller=utente&action=registra" method="POST" class="auth-form">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        
        <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" required>
        </div>

        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="tel" id="telefono" name="telefono">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn-primary">Registrati</button>
    </form>
    
    <p class="form-footer">Sei già iscritto? <a href="index.php?controller=utente&action=login">Accedi qui</a>.</p>
</div>
<?php
}
}
/* {/block "content"} */
}
