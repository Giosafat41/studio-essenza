<?php
/* Smarty version 5.8.5, created on 2026-11-24 16:33:32
  from 'file:admin_utente_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b05ae4c8f73b6_34039957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15909f4d042bb47be592bb92bc6840f30cbeea3c' => 
    array (
      0 => 'admin_utente_form.tpl',
      1 => 1795534304,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b05ae4c8f73b6_34039957 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_utente_form.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14667235516b05ae4c8e81b9_43961359', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_14667235516b05ae4c8e81b9_43961359 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-form-page py-2 py-md-3">

    <!-- Link ritorno alla Lista Utenti -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=utenti" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna alla Lista Utenti</span>
        </a>
    </div>

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2">Anagrafica Studio</span>
            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <h1 class="dashboard-title">Modifica Utente</h1>
                <p class="dashboard-subtitle">
                    Aggiorna i dati anagrafici, i crediti residui o la scadenza del certificato medico di <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
</strong>.
                </p>
            <?php } else { ?>
                <h1 class="dashboard-title">Crea Nuovo Utente</h1>
                <p class="dashboard-subtitle">
                    Registra un nuovo allievo, istruttore o amministratore nel sistema di Studio Essenza.
                </p>
            <?php }?>
        </div>

        <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
            <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
                <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_errore'), ENT_QUOTES, 'UTF-8', true);?>
</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
            </div>
        <?php }?>

        <form action="index.php?controller=admin&action=<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>modificaUtente<?php } else { ?>creaUtente<?php }?>" method="POST">

            <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('utente')->getId();?>
">
            <?php }?>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="nome" class="form-label auth-label">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control admin-input" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getNome(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="cognome" class="form-label auth-label">Cognome</label>
                    <input type="text" id="cognome" name="cognome" class="form-control admin-input" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getCognome(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="email" class="form-label auth-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control admin-input" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getEmail(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="telefono" class="form-label auth-label">Telefono <span class="auth-optional">(opzionale)</span></label>
                    <input type="tel" id="telefono" name="telefono" class="form-control admin-input" value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getTelefono(), ENT_QUOTES, 'UTF-8', true);
}?>">
                </div>
            </div>

            <?php if (!(true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>
                <div class="mb-3">
                    <label for="password" class="form-label auth-label">Password Iniziale</label>
                    <input type="password" id="password" name="password" class="form-control admin-input" required placeholder="Imposta una password per l'utente">
                </div>
            <?php }?>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="ruolo" class="form-label auth-label">Ruolo nel Sistema</label>
                    <select id="ruolo" name="ruolo" class="form-select admin-select" required>
                        <option value="allievo" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'allievo') {?>selected<?php }?>>Allievo</option>
                        <option value="istruttore" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'istruttore') {?>selected<?php }?>>Istruttore</option>
                        <option value="admin" <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null))) && $_smarty_tpl->getValue('utente')->getRuolo() == 'admin') {?>selected<?php }?>>Admin (Segreteria)</option>
                    </select>
                </div>

                <div class="col-12 col-sm-6">
                    <label for="crediti_residui" class="form-label auth-label">Crediti Residui</label>
                    <input type="number" id="crediti_residui" name="crediti_residui" class="form-control admin-input" min="0" required value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo $_smarty_tpl->getValue('utente')->getCreditiResidui();
} else { ?>0<?php }?>">
                </div>
            </div>

            <div class="mb-4">
                <label for="scadenza_certificato" class="form-label auth-label">Scadenza Certificato Medico <span class="auth-optional">(opzionale)</span></label>
                <input type="date" id="scadenza_certificato" name="scadenza_certificato" class="form-control admin-input" value="<?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('utente')->getScadenzaCertificato(), ENT_QUOTES, 'UTF-8', true);
}?>">
                <div class="form-text mt-1">Lascia vuoto se il certificato non è ancora stato consegnato.</div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary admin-action-btn px-4">
                    <?php if ((true && ($_smarty_tpl->hasVariable('utente') && null !== ($_smarty_tpl->getValue('utente') ?? null)))) {?>Salva Modifiche<?php } else { ?>Crea Utente<?php }?>
                </button>
                <a href="index.php?controller=admin&action=utenti" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>
<?php
}
}
/* {/block "content"} */
}
