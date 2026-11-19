<?php
/* Smarty version 5.8.5, created on 2026-11-19 19:10:17
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.5',
  'unifunc' => 'content_6aff3b89a30148_15496275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc042b03b4fc0b844e3145005cbfee532cb25cc7' => 
    array (
      0 => 'home.tpl',
      1 => 1795111793,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aff3b89a30148_15496275 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>
<!-- File: Smarty/templates/home.tpl -->


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7766681856aff3b89a205a8_93387507', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_7766681856aff3b89a205a8_93387507 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Gian\\Documents\\xampp\\htdocs\\studio-essenza\\Smarty\\templates';
?>

<div class="container my-5">

    <!-- Box Principale -->
    <div class="hero-section text-center p-5 bg-white rounded-3 shadow-sm mx-auto mb-5" style="max-width: 820px;">
        <h1 class="mb-3" style="color: #7b8b6f; font-size: 36px;">Studio Essenza</h1>
        <p class="fs-5 text-muted mb-4"><?php echo $_smarty_tpl->getValue('messaggio_benvenuto');?>
</p>

        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="index.php?controller=info&action=tariffe" class="btn btn-primary px-4 py-2">Scopri le Tariffe</a>
            <a href="index.php?controller=utente&action=login" class="btn btn-dark px-4 py-2">Accedi / Prenota</a>
        </div>
    </div>

    <!-- Sezione inferiore a 2 colonne affiancate -->
    <div class="row g-4 align-items-stretch">

        <!-- COLONNA SINISTRA: Carosello delle 3 Card Servizi -->
        <div class="col-12 col-lg-6">
            <div class="bg-white rounded-3 shadow-sm p-4 h-100 d-flex flex-column">
                <h2 class="h4 text-center mb-3" style="color: #7b8b6f;">Le Nostre Discipline</h2>

                <div id="carouselServizi" class="carousel carousel-dark slide my-auto" data-bs-ride="carousel">
                    
                    <!-- Indicatori inferiori -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselServizi" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Pilates Reformer"></button>
                        <button type="button" data-bs-target="#carouselServizi" data-bs-slide-to="1" aria-label="Pilates Matwork"></button>
                        <button type="button" data-bs-target="#carouselServizi" data-bs-slide-to="2" aria-label="Lezioni Individuali"></button>
                    </div>

                    <!-- Slide Servizi -->
                    <div class="carousel-inner pb-5 px-4">
                        <div class="carousel-item active">
                            <div class="card border-0 text-center carousel-card-essenza mx-auto">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <span class="badge rounded-pill mb-3" style="background-color: #eef1ec; color: #5f6e54;">Miniclassi</span>
                                    <h3 class="h5 fw-bold mb-2">Pilates Reformer</h3>
                                    <p class="text-muted mb-0">
                                        Allenamento completo sui macchinari in piccoli gruppi per la massima precisione posturale.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card border-0 text-center carousel-card-essenza mx-auto">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <span class="badge rounded-pill mb-3" style="background-color: #eef1ec; color: #5f6e54;">Corpo Libero</span>
                                    <h3 class="h5 fw-bold mb-2">Pilates Matwork</h3>
                                    <p class="text-muted mb-0">
                                        Esercizi a corpo libero sul tappetino per sviluppare forza nel core, flessibilità e controllo.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="card border-0 text-center carousel-card-essenza mx-auto">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <span class="badge rounded-pill mb-3" style="background-color: #eef1ec; color: #5f6e54;">1-to-1 &bull; 60 min</span>
                                    <h3 class="h5 fw-bold mb-2">Lezioni Individuali</h3>
                                    <p class="text-muted mb-0">
                                        Percorsi personalizzati cuciti sulle tue esigenze fisiche e sui tuoi obiettivi, con l'istruttore che preferisci.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Frecce Avanti/Indietro -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselServizi" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Precedente</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselServizi" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Successivo</span>
                    </button>
                </div>
            </div>
        </div>


        <!-- COLONNA DESTRA: Carosello Istruttori -->
        <div class="col-12 col-lg-6">
            <div class="bg-white rounded-3 shadow-sm p-4 h-100 d-flex flex-column">
                <h2 class="h4 text-center mb-3" style="color: #7b8b6f;">I Nostri Istruttori</h2>

                <?php if (( !$_smarty_tpl->hasVariable('istruttori') || empty($_smarty_tpl->getValue('istruttori')))) {?>
                    <div class="my-auto text-center text-muted py-5">
                        <p class="mb-0">Il team di istruttori certificati di Studio Essenza ti aspetta in sala.</p>
                    </div>
                <?php } else { ?>
                    <div id="carouselIstruttori" class="carousel carousel-dark slide my-auto" data-bs-ride="carousel">
                        
                        <!-- Indicatori inferiori -->
                        <div class="carousel-indicators">
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$_smarty_tpl->getVariable('istr')->iteration = 0;
$_smarty_tpl->getVariable('istr')->index = -1;
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach0DoElse = false;
$_smarty_tpl->getVariable('istr')->iteration++;
$_smarty_tpl->getVariable('istr')->index++;
$_smarty_tpl->getVariable('istr')->first = !$_smarty_tpl->getVariable('istr')->index;
$foreach0Backup = clone $_smarty_tpl->getVariable('istr');
?>
                                <button type="button"
                                        data-bs-target="#carouselIstruttori"
                                        data-bs-slide-to="<?php echo $_smarty_tpl->getVariable('istr')->index;?>
"
                                        class="<?php if ($_smarty_tpl->getVariable('istr')->first) {?>active<?php }?>"
                                        <?php if ($_smarty_tpl->getVariable('istr')->first) {?>aria-current="true"<?php }?>
                                        aria-label="Istruttore <?php echo $_smarty_tpl->getVariable('istr')->iteration;?>
"></button>
                            <?php
$_smarty_tpl->setVariable('istr', $foreach0Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </div>

                        <!-- Slide Istruttori -->
                        <div class="carousel-inner pb-5 px-4">
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('istruttori'), 'istr');
$_smarty_tpl->getVariable('istr')->iteration = 0;
$_smarty_tpl->getVariable('istr')->index = -1;
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('istr')->value) {
$foreach1DoElse = false;
$_smarty_tpl->getVariable('istr')->iteration++;
$_smarty_tpl->getVariable('istr')->index++;
$_smarty_tpl->getVariable('istr')->first = !$_smarty_tpl->getVariable('istr')->index;
$foreach1Backup = clone $_smarty_tpl->getVariable('istr');
?>
                                <div class="carousel-item <?php if ($_smarty_tpl->getVariable('istr')->first) {?>active<?php }?>">
                                    <div class="card border-0 text-center carousel-card-essenza mx-auto">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <div class="avatar-istruttore mb-3"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['iniziali'], ENT_QUOTES, 'UTF-8', true);?>
</div>
                                            <h3 class="h5 fw-bold mb-1"><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['nome'], ENT_QUOTES, 'UTF-8', true);?>
 <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('istr')['cognome'], ENT_QUOTES, 'UTF-8', true);?>
</h3>
                                            <span class="badge rounded-pill mb-3" style="background-color: #eef1ec; color: #5f6e54;">Istruttore Certificato</span>
                                            <p class="text-muted small mb-0">
                                                Specialista in Pilates Reformer, Matwork e percorsi posturali individuali.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
$_smarty_tpl->setVariable('istr', $foreach1Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </div>

                        <!-- Frecce Avanti/Indietro -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIstruttori" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Precedente</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselIstruttori" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Successivo</span>
                        </button>
                    </div>
                <?php }?>
            </div>
        </div>

    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
