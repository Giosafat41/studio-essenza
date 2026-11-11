<?php
/* Smarty version 5.8.5, created on 2026-11-11 12:23:11
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6af4501fd53917_16814606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05e2566920914a1d025ccd8269adbf91cfed9be6' => 
    array (
      0 => 'layout.tpl',
      1 => 1794396189,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af4501fd53917_16814606 (\Smarty\Template $_smarty_tpl) {
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

                <!-- Mostriamo link diversi se l'utente è loggato o meno -->
                <?php if ((true && ($_smarty_tpl->hasVariable('utente_loggato') && null !== ($_smarty_tpl->getValue('utente_loggato') ?? null)))) {?>
                    <li><a href="index.php?controller=utente&action=dashboard" class="btn-login">La mia Dashboard</a></li>
                <?php } else { ?>
                    <li><a href="index.php?controller=utente&action=login" class="btn-login">Accedi / Registrati</a></li>
                <?php }?>
            </ul>
        </nav>
    </header>

    <!-- CONTENUTO DINAMICO: Qui verranno inserite le pagine specifiche -->
    <main class="main-content">
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13243941956af4501fd51823_03874973', "content");
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
class Block_13243941956af4501fd51823_03874973 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
}
}
/* {/block "content"} */
}
