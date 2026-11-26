<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:23:26
  from 'file:admin_lezione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085cfeb8ae18_21843901',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a51a9421c71d9cd85e0af1951c5b99a8e66e6f05' => 
    array (
      0 => 'admin_lezione.tpl',
      1 => 1795710132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085cfeb8ae18_21843901 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_lezione.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5928748856b085cfeb828c2_30043751', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_5928748856b085cfeb828c2_30043751 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container admin-form-page py-2 py-md-3">

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

    <section class="dashboard-card">
        <div class="mb-4">
            <span class="auth-badge mb-2">Gestione Palinsesto</span>
            <h1 class="dashboard-title">Programma Nuova Lezione</h1>
            <p class="dashboard-subtitle">
                Inserisci una nuova classe di gruppo nel calendario settimanale di Studio Essenza.
            </p>
        </div>

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

        <form action="index.php?controller=admin&action=aggiungiLezione" method="POST">
            <div class="mb-3">
                <label for="id_corso" class="form-label auth-label">Tipo di Corso</label>
                <select id="id_corso" name="id_corso" class="form-select admin-select" required data-msg-required="Seleziona un corso dal menù a tendina.">
                    <option value="" selected disabled>Seleziona un corso...</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('corsi'), 'corso');
$foreach5DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('corso')->value) {
$foreach5DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('corso')->getId();?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('corso')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 (Max <?php echo $_smarty_tpl->getValue('corso')->getCapienzaMax();?>
 posti)</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_istruttore" class="form-label auth-label">Istruttore</label>
                <select id="id_istruttore" name="id_istruttore" class="form-select admin-select" required data-msg-required="Seleziona un istruttore dal menù a tendina.">
                    <option value="" selected disabled>Seleziona un istruttore...</option>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$foreach6DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach6DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('istr')->getId();?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')->getNome(), ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')->getCognome(), ENT_QUOTES, 'UTF-8', true);?>
</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-sm-6">
                    <label for="data_ora_inizio" class="form-label auth-label">Data e Ora di Inizio</label>
                    <input type="datetime-local" id="data_ora_inizio" name="data_ora_inizio" class="form-control admin-input" required data-msg-required="Seleziona la data e l'ora di inizio della lezione.">
                </div>

                <div class="col-12 col-sm-6">
                    <label for="durata_minuti" class="form-label auth-label">Durata</label>
                    <select id="durata_minuti" name="durata_minuti" class="form-select admin-select" required data-msg-required="Seleziona la durata della lezione.">
                        <option value="30">30 minuti</option>
                        <option value="60" selected>1 ora (60 min)</option>
                        <option value="90">1 ora e 30 min (90 min)</option>
                        <option value="120">2 ore (120 min)</option>
                        <option value="150">2 ore e 30 min (150 min)</option>
                        <option value="180">3 ore (180 min)</option>
                    </select>
                </div>
            </div>

            <div id="anteprima-fine-lezione" class="auth-support-note text-start mb-4 d-none"></div>

            <div class="auth-support-note text-start mb-4">
                Eventuali slot di disponibilità individuale liberi dell'istruttore sovrapposti a questo orario verranno rimossi automaticamente.
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <button type="submit" class="btn btn-primary admin-action-btn px-4">
                    Salva a Calendario
                </button>
                <a href="index.php?controller=admin&action=dashboard" class="btn btn-outline-essenza admin-action-btn px-4">
                    Annulla
                </a>
            </div>
        </form>
    </section>

</div>


<?php echo '<script'; ?>
>
document.addEventListener('DOMContentLoaded', function () {
    const inizioInput = document.getElementById('data_ora_inizio');
    const durataSelect = document.getElementById('durata_minuti');
    const anteprima = document.getElementById('anteprima-fine-lezione');

    if (!inizioInput || !durataSelect || !anteprima) return;

    function aggiornaAnteprima() {
        if (!inizioInput.value) {
            anteprima.classList.add('d-none');
            return;
        }
        const inizio = new Date(inizioInput.value);
        const minuti = parseInt(durataSelect.value, 10) || 60;
        if (isNaN(inizio.getTime())) {
            anteprima.classList.add('d-none');
            return;
        }
        const fine = new Date(inizio.getTime() + minuti * 60000);
        const pad = function (n) { return String(n).padStart(2, '0'); };
        const dataFine = pad(fine.getDate()) + '/' + pad(fine.getMonth() + 1) + '/' + fine.getFullYear();
        const oraFine = pad(fine.getHours()) + ':' + pad(fine.getMinutes());
        anteprima.innerHTML = 'Termine previsto: <strong>' + dataFine + ' alle ' + oraFine + '</strong>';
        anteprima.classList.remove('d-none');
    }

    inizioInput.addEventListener('input', aggiornaAnteprima);
    inizioInput.addEventListener('change', aggiornaAnteprima);
    durataSelect.addEventListener('change', aggiornaAnteprima);
});
<?php echo '</script'; ?>
>

<?php
}
}
/* {/block "content"} */
}
