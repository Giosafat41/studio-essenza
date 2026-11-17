<?php
/* Smarty version 5.8.5, created on 2026-11-17 16:11:09
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6e8d496b56_68291497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05e2566920914a1d025ccd8269adbf91cfed9be6' => 
    array (
      0 => 'layout.tpl',
      1 => 1794927696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6e8d496b56_68291497 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (($tmp = $_smarty_tpl->getValue('titolo_pagina') ?? null)===null||$tmp==='' ? 'Studio Essenza - Pilates Boutique' ?? null : $tmp);?>
</title>
    <link rel="stylesheet" href="/studio-essenza/css/general.css">
</head>
<body>

    <!-- HEADER E MENU DI NAVIGAZIONE -->
    <header class="main-header">
        <div class="logo">
            <a href="index.php?controller=utente&action=home">Studio Essenza</a>
        </div>
        <nav class="main-menu">
            <ul>
                <li><a href="index.php?controller=utente&action=home">Home</a></li>
                <li><a href="index.php?controller=info&action=metodo">Il Metodo</a></li>
                <li><a href="index.php?controller=info&action=tariffe">Tariffe</a></li>
                <li><a href="index.php?controller=info&action=contatti">Contatti</a></li>
                
                <?php if ((true && ($_smarty_tpl->hasVariable('utente_loggato') && null !== ($_smarty_tpl->getValue('utente_loggato') ?? null)))) {?>
                    <?php if ($_smarty_tpl->getValue('ruolo_loggato') == 'admin') {?>
                        <li><a href="index.php?controller=admin&action=dashboard" class="btn-login">Pannello Segreteria</a></li>
                    <?php } else { ?>
                        <li><a href="index.php?controller=utente&action=dashboard" class="btn-login">La mia Dashboard</a></li>
                    <?php }?>
                    <li><a href="index.php?controller=utente&action=logout" style="color: #d9534f;">Esci</a></li>
                <?php } else { ?>
                    <li><a href="index.php?controller=utente&action=login" class="btn-login">Accedi / Registrati</a></li>
                <?php }?>
            </ul>
        </nav>
    </header>

    <!-- CONTENUTO DINAMICO: Qui verranno inserite le pagine specifiche -->
    <main class="main-content">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20656132556afc6e8d494748_42296938', "content");
?>

    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <p>&copy; 2024 Studio Essenza Pilates. Tutti i diritti riservati.</p>
    </footer>

</body>
</html>
<?php }
/* {block "content"} */
class Block_20656132556afc6e8d494748_42296938 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
}
}
/* {/block "content"} */
}
