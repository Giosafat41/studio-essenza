<?php
/* Smarty version 5.8.5, created on 2026-11-17 16:11:39
  from 'file:metodo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6afc6eabcbee75_16595778',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e28c076d710f23180214810e97503d010442594d' => 
    array (
      0 => 'metodo.tpl',
      1 => 1794927696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6afc6eabcbee75_16595778 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/metodo.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14416022016afc6eabcbc811_87263233', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_14416022016afc6eabcbc811_87263233 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: #7b8b6f;">Il Metodo Essenza</h1>
        <p class="sottotitolo">Controllo, fluidità, respirazione e precisione al servizio del tuo corpo.</p>
    </div>

    <div style="background: white; padding: 35px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
        <h3 style="color: #7b8b6f; margin-top: 0;">La nostra filosofia</h3>
        <p style="line-height: 1.7;">
            In <strong>Studio Essenza</strong> lavoriamo esclusivamente in miniclassi (massimo 5 persone sui macchinari e 8 a corpo libero) per garantire una correzione posturale costante da parte di istruttori certificati. Il nostro approccio unisce i principi del Pilates classico alle moderne conoscenze biomeccaniche.
        </p>
    </div>

    <div class="grid-tariffe" style="margin-top: 20px;">
        <div class="card-tariffa" style="width: 100%; text-align: left;">
            <h3 style="color: #7b8b6f;">Pilates Reformer</h3>
            <p class="desc" style="line-height: 1.6;">
                Grazie al carrello mobile e alla resistenza progressiva delle molle, il Reformer permette di tonificare le catene muscolari profonde senza sovraccaricare le articolazioni. Ideale per migliorare la postura, la flessibilità e la forza del core.
            </p>
        </div>

        <div class="card-tariffa" style="width: 100%; text-align: left;">
            <h3 style="color: #7b8b6f;">Pilates Matwork & Small Props</h3>
            <p class="desc" style="line-height: 1.6;">
                Il lavoro sul tappetino rappresenta l'essenza pura del metodo di Joseph Pilates. Con l'ausilio di piccoli attrezzi (Magic Circle, Foam Roller, Fitball e bande elastiche), ogni lezione stimola equilibrio, coordinazione e consapevolezza corporea.
            </p>
        </div>
    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
