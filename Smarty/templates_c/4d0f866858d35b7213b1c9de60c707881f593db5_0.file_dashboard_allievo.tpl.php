<?php
/* Smarty version 5.8.5, created on 2026-11-17 15:53:40
  from 'file:dashboard_allievo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6a74ceefd5_08041085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d0f866858d35b7213b1c9de60c707881f593db5' => 
    array (
      0 => 'dashboard_allievo.tpl',
      1 => 1794926930,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6a74ceefd5_08041085 (\Smarty\Template $_smarty_tpl) {
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

        <section class="mie-prenotazioni" style="margin-top: 30px;">
            <h2>Le tue prossime lezioni</h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mie_prenotazioni')) == 0) {?>
                <p>Non hai ancora prenotato nessuna lezione.</p>
            <?php } else { ?>
                <ul style="list-style: none; padding: 0;">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mie_prenotazioni'), 'pren');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('pren')->value) {
$foreach0DoElse = false;
?>
                    <li style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <div>
                            <strong><?php echo $_smarty_tpl->getValue('pren')['nome_corso'];?>
</strong><br>
                            <small><?php echo $_smarty_tpl->getValue('pren')['data_ora'];?>
</small>
                        </div>
                        <form action="index.php?controller=prenotazione&action=cancella" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_prenotazione" value="<?php echo $_smarty_tpl->getValue('pren')['id_prenotazione'];?>
">
                            <button type="submit" class="btn-primary" style="background-color: #d9534f; padding: 8px 15px; font-size: 14px;">Disdici</button>
                        </form>
                    </li>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </ul>
            <?php }?>
        </section>
    </main>
</body>
</html>
<?php }
}
