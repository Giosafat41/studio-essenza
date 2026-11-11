<?php
/* Smarty version 5.8.5, created on 2026-11-11 12:11:24
  from 'file:tariffe.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6af44d5cb56988_74889764',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3700f056d6b4c73463ade1857dc0dfbfad78bf3' => 
    array (
      0 => 'tariffe.tpl',
      1 => 1794394499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af44d5cb56988_74889764 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- Diciamo a Smarty di usare il layout base -->


<!-- Riempiamo il blocco 'content' -->
<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17499502476af44d5ca8d2d1_97937434', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_17499502476af44d5ca8d2d1_97937434 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

    <div class="page-tariffe">
        <h1>Le nostre Tariffe</h1>
        <p class="sottotitolo">Scegli il pacchetto più adatto alle tue esigenze di allenamento.</p>

        <div class="grid-tariffe">

            <div class="card-tariffa">
                <h3>Lezione Singola</h3>
                <p class="prezzo">20€</p>
                <p class="desc">Ideale per provare il nostro metodo.</p>
            </div>

            <div class="card-tariffa premium">
                <h3>Pacchetto 10 Ingressi</h3>
                <p class="prezzo">180€</p>
                <p class="desc">Il pacchetto più scelto dai nostri allievi. <br><em>Scadenza: 3 mesi</em></p>
            </div>

            <div class="card-tariffa">
                <h3>Lezione Privata (Duetto)</h3>
                <p class="prezzo">35€ <small>a persona</small></p>
                <p class="desc">Allenati con un partner per la massima attenzione.</p>
            </div>

        </div>

        <div class="avviso-pagamenti">
            <p><strong>Nota bene:</strong> L'attivazione dei pacchetti e i pagamenti (contanti o POS) avvengono esclusivamente presso la segreteria dello studio.</p>
        </div>
    </div>
<?php
}
}
/* {/block "content"} */
}
