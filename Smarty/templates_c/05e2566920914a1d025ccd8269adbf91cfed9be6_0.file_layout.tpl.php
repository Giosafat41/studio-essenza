<?php
/* Smarty version 5.8.5, created on 2026-11-26 17:23:25
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6b085cfde8e3c7_23446191',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05e2566920914a1d025ccd8269adbf91cfed9be6' => 
    array (
      0 => 'layout.tpl',
      1 => 1795710013,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b085cfde8e3c7_23446191 (\Smarty\Template $_smarty_tpl) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/studio-essenza/css/general.css?v=11">
</head>
<body>

    <!-- HEADER E MENU DI NAVIGAZIONE -->
    <header class="main-header">
        <div class="logo">
            <a href="index.php?controller=utente&action=home">
                <img src="/studio-essenza/doc/img/logo.png" alt="Studio Essenza">
            </a>
        </div>
        <nav class="main-menu">
            <ul>
                <li><a href="index.php?controller=utente&action=home">Home</a></li>
                <li><a href="index.php?controller=info&action=metodo">Il Metodo</a></li>
                <li><a href="index.php?controller=info&action=tariffe">Tariffe</a></li>
                <li><a href="index.php?controller=info&action=contatti">Contatti</a></li>
                
                <?php if ((true && ($_smarty_tpl->hasVariable('utente_loggato') && null !== ($_smarty_tpl->getValue('utente_loggato') ?? null)))) {?>
                    <?php if ($_smarty_tpl->getValue('ruolo_loggato') == 'admin') {?>
                        <li><a href="index.php?controller=admin&action=dashboard" class="btn-login">Pannello Admin</a></li>
                    <?php } elseif ($_smarty_tpl->getValue('ruolo_loggato') == 'segretaria') {?>
                        <li><a href="index.php?controller=segretaria&action=dashboard" class="btn-login">Pannello Segreteria</a></li>
                    <?php } elseif ($_smarty_tpl->getValue('ruolo_loggato') == 'istruttore') {?>
                        <li><a href="index.php?controller=istruttore&action=dashboard" class="btn-login">Area Istruttore</a></li>
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
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4197033006b085cfde8d6c4_68017656', "content");
?>

    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <p>&copy; 2024 Studio Essenza Pilates. Tutti i diritti riservati.</p>
    </footer>

    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/studio-essenza/js/form-validation.js?v=1"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
/* {block "content"} */
class Block_4197033006b085cfde8d6c4_68017656 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
}
}
/* {/block "content"} */
}
