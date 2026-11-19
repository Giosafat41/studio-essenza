<!-- File: Smarty/templates/home.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container my-5">

    <!-- Box Principale -->
    <div class="hero-section text-center p-5 bg-white rounded-3 shadow-sm mx-auto mb-5" style="max-width: 820px;">
        <h1 class="mb-3" style="color: #7b8b6f; font-size: 36px;">Studio Essenza</h1>
        <p class="fs-5 text-muted mb-4">{$messaggio_benvenuto}</p>

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

                {if empty($istruttori)}
                    <div class="my-auto text-center text-muted py-5">
                        <p class="mb-0">Il team di istruttori certificati di Studio Essenza ti aspetta in sala.</p>
                    </div>
                {else}
                    <div id="carouselIstruttori" class="carousel carousel-dark slide my-auto" data-bs-ride="carousel">
                        
                        <!-- Indicatori inferiori -->
                        <div class="carousel-indicators">
                            {foreach $istruttori as $istr}
                                <button type="button"
                                        data-bs-target="#carouselIstruttori"
                                        data-bs-slide-to="{$istr@index}"
                                        class="{if $istr@first}active{/if}"
                                        {if $istr@first}aria-current="true"{/if}
                                        aria-label="Istruttore {$istr@iteration}"></button>
                            {/foreach}
                        </div>

                        <!-- Slide Istruttori -->
                        <div class="carousel-inner pb-5 px-4">
                            {foreach $istruttori as $istr}
                                <div class="carousel-item {if $istr@first}active{/if}">
                                    <div class="card border-0 text-center carousel-card-essenza mx-auto">
                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                            <div class="avatar-istruttore mb-3">{$istr.iniziali|escape}</div>
                                            <h3 class="h5 fw-bold mb-1">{$istr.nome|escape} {$istr.cognome|escape}</h3>
                                            <span class="badge rounded-pill mb-3" style="background-color: #eef1ec; color: #5f6e54;">Istruttore Certificato</span>
                                            <p class="text-muted small mb-0">
                                                Specialista in Pilates Reformer, Matwork e percorsi posturali individuali.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            {/foreach}
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
                {/if}
            </div>
        </div>

    </div>
</div>
{/block}
