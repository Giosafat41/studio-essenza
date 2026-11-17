<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:37:19
  from 'file:admin_lezione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc669f47fe39_76447441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a51a9421c71d9cd85e0af1951c5b99a8e66e6f05' => 
    array (
      0 => 'admin_lezione.tpl',
      1 => 1794926123,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc669f47fe39_76447441 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_lezione.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15285477436afc669f472be6_59126838', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_15285477436afc669f472be6_59126838 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="form-container">
    <h2>Programma Nuova Lezione</h2>
    <p class="sottotitolo">Inserisci una nuova classe nel calendario dello studio.</p>
    
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div class="alert-success" style="color: green; margin-bottom:15px; font-weight:bold;"><?php echo $_smarty_tpl->getValue('messaggio_successo');?>
</div>
    <?php }?>

    <form action="index.php?controller=admin&action=aggiungiLezione" method="POST" class="auth-form">
        
        <div class="form-group">
            <label for="id_corso">Tipo di Corso</label>
            <select id="id_corso" name="id_corso" required>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'corso');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('corso')->getId();?>
"><?php echo $_smarty_tpl->getValue('corso')->getNome();?>
 (Max <?php echo $_smarty_tpl->getValue('corso')->getCapienzaMax();?>
 posti)</option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_istruttore">Istruttore</label>
            <select id="id_istruttore" name="id_istruttore" required>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach1DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('istr')->getId();?>
"><?php echo $_smarty_tpl->getValue('istr')->getNome();?>
 <?php echo $_smarty_tpl->getValue('istr')->getCognome();?>
</option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </div>

        <div class="form-group">
            <label for="data_ora_inizio">Data e Ora di Inizio</label>
            <!-- L'input datetime-local apre il calendario nativo del browser -->
            <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" required>
        </div>

        <div class="form-group">
            <label for="data_ora_fine">Data e Ora di Fine</label>
            <input type="datetime-local" id="data_ora_fine" name="data_ora_fine" required>
        </div>
        
        <button type="submit" class="btn-primary">Salva a Calendario</button>
    </form>
    
    <p class="form-footer"><a href="index.php?controller=admin&action=dashboard">&larr; Torna alla Dashboard</a></p>
</div>
<?php
}
}
/* {/block "content"} */
}
