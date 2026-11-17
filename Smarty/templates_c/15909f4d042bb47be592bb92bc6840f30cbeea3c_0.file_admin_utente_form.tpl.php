<?php
/* Smarty version 5.8.5, created on 2026-11-17 18:05:20
  from 'file:admin_utente_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc8950131c07_90425271',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15909f4d042bb47be592bb92bc6840f30cbeea3c' => 
    array (
      0 => 'admin_utente_form.tpl',
      1 => 1794934998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc8950131c07_90425271 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utente_form.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14219783516afc8950121576_07183639', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_14219783516afc8950121576_07183639 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="dashboard-wrapper" style="max-width: 650px;">
    <div class="dashboard-card">
        
        <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
            <h2>Modifica Utente #<?php echo $_smarty_tpl->getValue('utente')->getId();?>
</h2>
            <p class="sottotitolo">Aggiorna i dati anagrafici, i crediti o la scadenza del certificato medico.</p>
        <?php } else { ?>
            <h2>Crea Nuovo Utente</h2>
            <p class="sottotitolo">Registra un nuovo allievo, istruttore o amministratore.</p>
        <?php }?>

        <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                <?php echo $_smarty_tpl->getValue('messaggio_errore');?>

            </div>
        <?php }?>

        <form action="index.php?controller=admin&action=<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>modificaUtente<?php } else { ?>creaUtente<?php }?>" method="POST" class="auth-form">
            
            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('utente')->getId();?>
">
            <?php }?>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nome" style="display:block; margin-bottom:5px; font-weight:bold;">Nome</label>
                <input type="text" id="nome" name="nome" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getNome();
}?>" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="cognome" style="display:block; margin-bottom:5px; font-weight:bold;">Cognome</label>
                <input type="text" id="cognome" name="cognome" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getCognome();
}?>" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="email" style="display:block; margin-bottom:5px; font-weight:bold;">Email</label>
                <input type="email" id="email" name="email" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getEmail();
}?>" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <?php if (!(true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="password" style="display:block; margin-bottom:5px; font-weight:bold;">Password Iniziale</label>
                    <input type="password" id="password" name="password" required placeholder="Imposta una password per l'utente" style="width:100%; padding:10px; box-sizing:border-box;">
                </div>
            <?php }?>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="telefono" style="display:block; margin-bottom:5px; font-weight:bold;">Telefono</label>
                <input type="tel" id="telefono" name="telefono" value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getTelefono();
}?>" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="ruolo" style="display:block; margin-bottom:5px; font-weight:bold;">Ruolo nel Sistema</label>
                <select id="ruolo" name="ruolo" required style="width:100%; padding:10px; box-sizing:border-box;">
                    <option value="allievo" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'allievo') {?>selected<?php }?>>Allievo</option>
                    <option value="istruttore" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'istruttore') {?>selected<?php }?>>Istruttore</option>
                    <option value="admin" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'admin') {?>selected<?php }?>>Admin (Segreteria)</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="crediti_residui" style="display:block; margin-bottom:5px; font-weight:bold;">Crediti Residui</label>
                <input type="number" id="crediti_residui" name="crediti_residui" min="0" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getCreditiResidui();
} else { ?>0<?php }?>" style="width:100%; padding:10px; box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label for="scadenza_certificato" style="display:block; margin-bottom:5px; font-weight:bold;">Scadenza Certificato Medico</label>
                <input type="date" id="scadenza_certificato" name="scadenza_certificato" value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getScadenzaCertificato();
}?>" style="width:100%; padding:10px; box-sizing:border-box;">
                <small style="color: #777;">Lascia vuoto se il certificato non è ancora stato consegnato.</small>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-primary">
                    <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>Salva Modifiche<?php } else { ?>Crea Utente<?php }?>
                </button>
                <a href="index.php?controller=admin&action=utenti" class="btn-primary" style="background-color: #6c757d;">Annulla</a>
            </div>
        </form>

    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
