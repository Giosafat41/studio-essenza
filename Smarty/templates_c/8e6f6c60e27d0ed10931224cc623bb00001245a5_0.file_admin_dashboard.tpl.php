<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:54:13
  from 'file:admin_dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6a95966234_69154297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e6f6c60e27d0ed10931224cc623bb00001245a5' => 
    array (
      0 => 'admin_dashboard.tpl',
      1 => 1794927094,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6a95966234_69154297 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/admin_dashboard.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6315506776afc6a95963525_73966859', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_6315506776afc6a95963525_73966859 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="dashboard-container">
    <header class="header-boutique" style="background-color: #e9ecef;">
        <h1>Pannello Segreteria</h1>
        <p>Benvenuto/a, <?php echo $_smarty_tpl->getValue('nome_admin');?>
 (Amministratore)</p>
    </header>

    <div class="grid-tariffe" style="margin-top: 30px;">
        
        <!-- Blocco 1: Gestione Crediti -->
        <div class="card-tariffa">
            <h3>Ricarica Crediti</h3>
            <p class="desc">Aggiungi ingressi al profilo di un allievo dopo il pagamento in sede.</p>
            <br>
            <a href="index.php?controller=admin&action=ricaricaCrediti" class="btn-primary">Vai alla Ricarica</a>
        </div>
        
        <!-- Blocco 2: Gestione Calendario -->
        <div class="card-tariffa premium">
            <h3>Gestione Palinsesto</h3>
            <p class="desc">Inserisci nuove lezioni a calendario scegliendo corso, orario e istruttore.</p>
            <br>
            <a href="index.php?controller=admin&action=aggiungiLezione" class="btn-primary" style="background-color: #7b8b6f; color:white;">Nuova Lezione</a>
        </div>

        <!-- Blocco 3: Appello -->
        <div class="card-tariffa">
            <h3>Registro Appello</h3>
            <p class="desc">Controlla la lista degli iscritti (inserisci l'ID della lezione).</p>
            <br>
            <form action="index.php" method="GET" style="display:flex; gap:10px; justify-content:center;">
                <input type="hidden" name="controller" value="admin">
                <input type="hidden" name="action" value="appello">
                <input type="number" name="id_lezione" placeholder="ID Lez." required style="width:70px; padding:5px;">
                <button type="submit" class="btn-primary" style="padding: 5px 10px;">Cerca</button>
            </form>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <a href="index.php?controller=utente&action=logout" style="color: #d9534f; text-decoration: none; font-weight: bold;">Esci dall'account Admin</a>
    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
