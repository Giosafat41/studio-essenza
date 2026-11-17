<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:26:31
  from 'file:calendario.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc641715cc73_74273412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f2f24f1c95061c8a0b60d481d6e90d79af2886a' => 
    array (
      0 => 'calendario.tpl',
      1 => 1794925497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc641715cc73_74273412 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/calendario.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_254828446afc6416d7fd68_42411056', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_254828446afc6416d7fd68_42411056 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="calendario-container">
    <h2>Calendario Lezioni</h2>
    <p class="sottotitolo">I tuoi crediti disponibili: <strong><?php echo $_smarty_tpl->getValue('crediti');?>
</strong></p>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('calendario')) == 0) {?>
        <div class="alert-info">Non ci sono lezioni in programma per i prossimi 7 giorni.</div>
    <?php } else { ?>
        <div class="grid-lezioni">
            <!-- Cicliamo l'array preparato nel Controller -->
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('calendario'), 'lezione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('lezione')->value) {
$foreach0DoElse = false;
?>
                <div class="card-lezione">
                    <h3><?php echo $_smarty_tpl->getValue('lezione')['nome_corso'];?>
</h3>
                    <p class="data-ora"><?php echo $_smarty_tpl->getValue('lezione')['data_formattata'];?>
</p>
                    
                    <!-- Form invisibile per inviare l'ID della lezione via POST -->
                    <form action="index.php?controller=prenotazione&action=prenota" method="POST">
                        <input type="hidden" name="id_lezione" value="<?php echo $_smarty_tpl->getValue('lezione')['id_lezione'];?>
">
                        <button type="submit" class="btn-primary btn-prenota">Prenota Ora</button>
                    </form>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</div>
<?php
}
}
/* {/block "content"} */
}
