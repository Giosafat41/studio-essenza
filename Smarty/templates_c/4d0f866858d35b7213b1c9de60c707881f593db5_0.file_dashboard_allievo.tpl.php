<?php
/* Smarty version 5.8.5, created on 2026-11-11 12:39:55
  from 'file:dashboard_allievo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6af4540b1de0f6_05598356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d0f866858d35b7213b1c9de60c707881f593db5' => 
    array (
      0 => 'dashboard_allievo.tpl',
      1 => 1794393631,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af4540b1de0f6_05598356 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Allievo</title>
    <!-- Collegamento al CSS nella cartella Smarty -->
    <link rel="stylesheet" href="Smarty/css/general.css">
</head>
<body>
    <header class="header-boutique">
        <h1>Studio Essenza</h1>
        <p>Bentornato, <?php echo $_smarty_tpl->getValue('nome_utente');?>
!</p>
    </header>

    <main class="dashboard-container">
        <section class="saldo-crediti">
            <h2>Il tuo Saldo Attuale</h2>
            <p class="numero-grande"><?php echo $_smarty_tpl->getValue('crediti');?>
 lezioni disponibili</p>

            <!-- Logica if/else direttamente in HTML tramite Smarty -->
            <?php if ($_smarty_tpl->getValue('avviso_crediti')) {?>
                <div class="avviso-rinnovo">
                    <strong>Attenzione:</strong> i tuoi ingressi stanno per esaurirsi. 
                    Ricordati di passare in segreteria per il rinnovo!
                </div>
            <?php }?>
        </section>

        <section class="azioni-rapide">
            <a href="?controller=prenotazione&action=calendario" class="bottone-prenota">Prenota una nuova lezione</a>
        </section>
    </main>
</body>
</html>
<?php }
}
