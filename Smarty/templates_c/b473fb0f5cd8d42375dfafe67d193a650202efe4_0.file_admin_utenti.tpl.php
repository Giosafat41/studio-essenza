<?php
/* Smarty version 5.8.5, created on 2026-11-17 18:05:15
  from 'file:admin_utenti.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc894b63d533_03945823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b473fb0f5cd8d42375dfafe67d193a650202efe4' => 
    array (
      0 => 'admin_utenti.tpl',
      1 => 1794934998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc894b63d533_03945823 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utenti.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9443904416afc894b6271f3_57485644', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_9443904416afc894b6271f3_57485644 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="dashboard-wrapper" style="max-width: 1150px;">
    
    <div class="dashboard-welcome">
        <div>
            <h1>Anagrafica Utenti Iscritti</h1>
            <p class="sottotitolo">Visualizza e modifica i dati completi, i crediti e il certificato medico di ogni utente.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="index.php?controller=admin&action=creaUtente" class="btn-primary">+ Nuovo Utente</a>
            <a href="index.php?controller=admin&action=dashboard" class="btn-primary" style="background-color: #6c757d;">&larr; Dashboard</a>
        </div>
    </div>

    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-weight: bold;">
            <?php echo $_smarty_tpl->getValue('messaggio_successo');?>

        </div>
    <?php }?>

    <div class="dashboard-card" style="overflow-x: auto;">
        <?php if (( !$_smarty_tpl->hasVariable('utenti') || empty($_smarty_tpl->getValue('utenti')))) {?>
            <p>Nessun utente registrato nel sistema.</p>
        <?php } else { ?>
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #7b8b6f; color: #7b8b6f;">
                        <th style="padding: 12px 8px;">ID</th>
                        <th style="padding: 12px 8px;">Nome e Cognome</th>
                        <th style="padding: 12px 8px;">Email</th>
                        <th style="padding: 12px 8px;">Telefono</th>
                        <th style="padding: 12px 8px;">Ruolo</th>
                        <th style="padding: 12px 8px;">Crediti</th>
                        <th style="padding: 12px 8px;">Scadenza Certificato</th>
                        <th style="padding: 12px 8px;">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('utenti'), 'u');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('u')->value) {
$foreach0DoElse = false;
?>
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 12px 8px;">#<?php echo $_smarty_tpl->getValue('u')->getId();?>
</td>
                            <td style="padding: 12px 8px;"><strong><?php echo $_smarty_tpl->getValue('u')->getCognome();?>
 <?php echo $_smarty_tpl->getValue('u')->getNome();?>
</strong></td>
                            <td style="padding: 12px 8px;"><?php echo $_smarty_tpl->getValue('u')->getEmail();?>
</td>
                            <td style="padding: 12px 8px;"><?php echo (($tmp = $_smarty_tpl->getValue('u')->getTelefono() ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</td>
                            <td style="padding: 12px 8px;">
                                <span style="text-transform: uppercase; font-size: 12px; font-weight: bold; padding: 3px 8px; border-radius: 4px; background: #f0f0f0;">
                                    <?php echo $_smarty_tpl->getValue('u')->getRuolo();?>

                                </span>
                            </td>
                            <td style="padding: 12px 8px; font-weight: bold;"><?php echo $_smarty_tpl->getValue('u')->getCreditiResidui();?>
</td>
                            <td style="padding: 12px 8px;">
                                <?php if ($_smarty_tpl->getValue('u')->getScadenzaCertificato()) {?>
                                    <?php if ($_smarty_tpl->getValue('u')->haCertificatoValido()) {?>
                                        <span style="color: #28a745; font-weight: bold;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('u')->getScadenzaCertificato(),"%d/%m/%Y");?>
</span>
                                    <?php } else { ?>
                                        <span style="color: #d9534f; font-weight: bold;">Scaduto (<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('u')->getScadenzaCertificato(),"%d/%m/%Y");?>
)</span>
                                    <?php }?>
                                <?php } else { ?>
                                    <span style="color: #999;">Non presente</span>
                                <?php }?>
                            </td>
                            <td style="padding: 12px 8px;">
                                <a href="index.php?controller=admin&action=modificaUtente&id=<?php echo $_smarty_tpl->getValue('u')->getId();?>
" class="btn-primary" style="padding: 6px 12px; font-size: 13px;">Modifica</a>
                            </td>
                        </tr>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
        <?php }?>
    </div>

</div>
<?php
}
}
/* {/block "content"} */
}
