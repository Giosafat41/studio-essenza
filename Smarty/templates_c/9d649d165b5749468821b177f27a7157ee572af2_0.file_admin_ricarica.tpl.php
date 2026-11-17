<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:35:51
  from 'file:admin_ricarica.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6647f360e0_38260386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d649d165b5749468821b177f27a7157ee572af2' => 
    array (
      0 => 'admin_ricarica.tpl',
      1 => 1794926108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6647f360e0_38260386 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_ricarica.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13492626086afc6647f2f3a2_44594930', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_13492626086afc6647f2f3a2_44594930 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="form-container">
    <h2>Ricarica Crediti Allievo</h2>
    <p class="sottotitolo">Aggiungi pacchetti ingressi dopo il pagamento in sede.</p>
    
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div class="alert-success" style="color: green; margin-bottom:15px; font-weight:bold;"><?php echo $_smarty_tpl->getValue('messaggio_successo');?>
</div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
        <div class="alert-error" style="color: red; margin-bottom:15px; font-weight:bold;"><?php echo $_smarty_tpl->getValue('messaggio_errore');?>
</div>
    <?php }?>

    <form action="index.php?controller=admin&action=ricaricaCrediti" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email_allievo">Email Allievo</label>
            <input type="email" id="email_allievo" name="email_allievo" required placeholder="es. mario.rossi@email.com">
        </div>
        
        <div class="form-group">
            <label for="quantita_crediti">Crediti da aggiungere</label>
            <select id="quantita_crediti" name="quantita_crediti" required>
                <option value="1">1 Lezione (Singola)</option>
                <option value="5">5 Lezioni (Pacchetto Base)</option>
                <option value="10">10 Lezioni (Pacchetto Premium)</option>
            </select>
        </div>
        
        <button type="submit" class="btn-primary">Aggiorna Saldo</button>
    </form>
    
    <p class="form-footer"><a href="index.php?controller=admin&action=dashboard">&larr; Torna alla Dashboard</a></p>
</div>
<?php
}
}
/* {/block "content"} */
}
