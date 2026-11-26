<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:23:26
  from 'file:admin_corsi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085cfe980cf1_61349411',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a15f1bc5ba36b8bf4178a2c8e60e36a924b719c' => 
    array (
      0 => 'admin_corsi.tpl',
      1 => 1795710131,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085cfe980cf1_61349411 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_corsi.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16712475806b085cfe972ae5_53546125', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_16712475806b085cfe972ae5_53546125 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-wide-page py-2 py-md-3">

    <!-- Link ritorno al Pannello Admin -->
    <div class="mb-3">
        <a href="index.php?controller=admin&action=dashboard" class="calendar-back-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Torna al Pannello Admin</span>
        </a>
    </div>

    <!-- Intestazione -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Amministrazione</span>
                <h1 class="dashboard-title">Gestione Corsi</h1>
                <p class="dashboard-subtitle">
                    Inserisci e aggiorna le tipologie di corsi di gruppo disponibili per la programmazione delle lezioni.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="index.php?controller=admin&action=aggiungiLezione" class="btn btn-primary dashboard-cta-btn w-100">
                    + Programma Nuova Lezione
                </a>
            </div>
        </div>
    </section>

    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_successo') && null !== ($_smarty_tpl->getValue('messaggio_successo') ?? null)))) {?>
        <div class="alert auth-alert-success fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_successo'), ENT_QUOTES, 'UTF-8', true);?>
</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('messaggio_errore') && null !== ($_smarty_tpl->getValue('messaggio_errore') ?? null)))) {?>
        <div class="alert auth-alert-error fade show d-flex align-items-center justify-content-between gap-2 mb-4" role="alert">
            <span><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('messaggio_errore'), ENT_QUOTES, 'UTF-8', true);?>
</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi"></button>
        </div>
    <?php }?>

    <div class="row g-4 align-items-start">

        <!-- Form Inserimento / Modifica Corso -->
        <div class="col-12 col-lg-4">
            <section class="dashboard-card">
                <h2 class="dashboard-section-title mb-3">
                    <?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {?>Modifica Corso<?php } else { ?>Nuovo Corso<?php }?>
                </h2>

                <form action="index.php?controller=admin&action=salvaCorso" method="POST">
                    <?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {?>
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->getValue('corso_in_modifica')->getId();?>
">
                    <?php }?>

                    <div class="mb-3">
                        <label for="nome" class="form-label auth-label">Nome del Corso</label>
                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            class="form-control admin-input"
                            required
                            data-msg-required="Inserisci il nome del corso."
                            maxlength="100"
                            placeholder="Es. Pilates Reformer"
                            value="<?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('corso_in_modifica')->getNome(), ENT_QUOTES, 'UTF-8', true);
}?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="capienza_max" class="form-label auth-label">Capienza Massima (posti)</label>
                        <input
                            type="number"
                            id="capienza_max"
                            name="capienza_max"
                            class="form-control admin-input"
                            required
                            data-msg-required="Inserisci la capienza massima del corso."
                            data-msg-min="La capienza minima consentita è 1 posto."
                            data-msg-max="La capienza massima consentita è 100 posti."
                            min="1"
                            max="100"
                            value="<?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {
echo $_smarty_tpl->getValue('corso_in_modifica')->getCapienzaMax();
} else { ?>8<?php }?>"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="descrizione" class="form-label auth-label">Descrizione <span class="auth-optional">(opzionale)</span></label>
                        <textarea
                            id="descrizione"
                            name="descrizione"
                            class="form-control admin-input"
                            rows="3"
                            placeholder="Breve descrizione della disciplina..."
                        ><?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {
echo htmlspecialchars((string)$_smarty_tpl->getValue('corso_in_modifica')->getDescrizione(), ENT_QUOTES, 'UTF-8', true);
}?></textarea>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <button type="submit" class="btn btn-primary admin-action-btn w-100">
                            <?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {?>Salva Modifiche<?php } else { ?>Inserisci Corso<?php }?>
                        </button>
                        <?php if ((true && ($_smarty_tpl->hasVariable('corso_in_modifica') && null !== ($_smarty_tpl->getValue('corso_in_modifica') ?? null)))) {?>
                            <a href="index.php?controller=admin&action=corsi" class="btn btn-outline-essenza admin-action-btn w-100">
                                Annulla Modifica
                            </a>
                        <?php }?>
                    </div>
                </form>
            </section>
        </div>

        <!-- Elenco Corsi Esistenti -->
        <div class="col-12 col-lg-8">
            <section class="dashboard-card">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                    <h2 class="dashboard-section-title">Elenco Corsi dello Studio</h2>
                    <span class="dashboard-count-badge">
                        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('corsi'));?>
 <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('corsi')) == 1) {?>corso<?php } else { ?>corsi<?php }?>
                    </span>
                </div>

                <?php if (( !$_smarty_tpl->hasVariable('corsi') || empty($_smarty_tpl->getValue('corsi')))) {?>
                    <div class="dashboard-empty">
                        <p class="dashboard-empty-title">Nessun corso presente</p>
                        <p class="dashboard-empty-text">Usa il modulo a sinistra per inserire il primo corso di Studio Essenza.</p>
                    </div>
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table admin-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Corso</th>
                                    <th>Capienza</th>
                                    <th>Lezioni</th>
                                    <th class="text-end">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'c');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('c')->value) {
$foreach4DoElse = false;
?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('c')['nome'], ENT_QUOTES, 'UTF-8', true);?>
</strong>
                                            <?php if (!( !true || empty($_smarty_tpl->getValue('c')['descrizione']))) {?>
                                                <div class="text-muted small mt-1"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('c')['descrizione'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <span class="dashboard-count-badge"><?php echo $_smarty_tpl->getValue('c')['capienza_max'];?>
 posti</span>
                                        </td>
                                        <td><?php echo $_smarty_tpl->getValue('c')['num_lezioni'];?>
</td>
                                        <td class="text-end text-nowrap">
                                            <a href="index.php?controller=admin&action=corsi&edit=<?php echo $_smarty_tpl->getValue('c')['id'];?>
" class="btn btn-sm btn-outline-essenza">
                                                Modifica
                                            </a>
                                            <?php if ($_smarty_tpl->getValue('c')['num_lezioni'] == 0) {?>
                                                <form action="index.php?controller=admin&action=eliminaCorso" method="POST" class="d-inline" onsubmit="return confirm('Vuoi davvero eliminare il corso <?php echo strtr((string)$_smarty_tpl->getValue('c')['nome'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
						"\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
						"`" => "\\`", "\${" => "\\\$\{"));?>
?');">
                                                    <input type="hidden" name="id_corso" value="<?php echo $_smarty_tpl->getValue('c')['id'];?>
">
                                                    <button type="submit" class="btn btn-sm btn-disdici ms-1">Elimina</button>
                                                </form>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                            </tbody>
                        </table>
                    </div>
                <?php }?>
            </section>
        </div>

    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
