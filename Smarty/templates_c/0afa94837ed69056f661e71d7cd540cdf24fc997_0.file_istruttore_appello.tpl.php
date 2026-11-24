<?php
/* Smarty version 5.8.5, created on 2026-11-24 17:13:51
  from 'file:istruttore_appello.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b05b7bf87e895_79089164',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0afa94837ed69056f661e71d7cd540cdf24fc997' => 
    array (
      0 => 'istruttore_appello.tpl',
      1 => 1795110561,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b05b7bf87e895_79089164 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/istruttore_appello.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18379929956b05b7bf85ed86_23853570', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_18379929956b05b7bf85ed86_23853570 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container my-4" style="max-width: 920px;">

    <div class="bg-white rounded-3 shadow-sm p-4 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h4 mb-1" style="color: #7b8b6f;">Registro Appello</h1>
            <p class="text-muted mb-0">
                <strong><?php echo $_smarty_tpl->getValue('lezione')['nome_corso'];?>
</strong> &bull; <?php echo $_smarty_tpl->getValue('lezione')['data'];?>
 (<?php echo $_smarty_tpl->getValue('lezione')['orario'];?>
) &bull;
                Posti occupati: <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('iscritti'));?>
 / <?php echo $_smarty_tpl->getValue('lezione')['capienza_max'];?>
</strong>
            </p>
        </div>
        <a href="index.php?controller=istruttore&action=dashboard" class="btn btn-secondary">&larr; Torna alla Dashboard</a>
    </div>

    <div class="bg-white rounded-3 shadow-sm p-4">
        <?php if (( !$_smarty_tpl->hasVariable('iscritti') || empty($_smarty_tpl->getValue('iscritti')))) {?>
            <p class="text-muted mb-0">Nessun allievo risulta prenotato per questo corso.</p>
        <?php } else { ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('allievo')->value) {
$foreach0DoElse = false;
$_smarty_tpl->getVariable('allievo')->iteration++;
$foreach0Backup = clone $_smarty_tpl->getVariable('allievo');
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->getVariable('allievo')->iteration;?>
</td>
                                <td><strong><?php echo $_smarty_tpl->getValue('allievo')['cognome'];?>
 <?php echo $_smarty_tpl->getValue('allievo')['nome'];?>
</strong></td>
                                <td><?php echo (($tmp = $_smarty_tpl->getValue('allievo')['telefono'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                                <td><?php echo $_smarty_tpl->getValue('allievo')['email'];?>
</td>
                                <td>
                                    <?php if ($_smarty_tpl->getValue('allievo')['certificato_valido']) {?>
                                        <span class="badge bg-success">Valido</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">Scaduto / Non valido</span>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php
$_smarty_tpl->setVariable('allievo', $foreach0Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php }?>
    </div>

</div>
<?php
}
}
/* {/block "content"} */
}
