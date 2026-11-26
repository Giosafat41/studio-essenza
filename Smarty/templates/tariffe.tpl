<!-- File: Smarty/templates/tariffe.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="container dashboard-page py-2 py-md-3">

    <!-- Hero Intestazione Tariffe -->
    <section class="dashboard-card dashboard-hero mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <span class="auth-badge mb-2">Listino Studio Essenza</span>
                <h1 class="dashboard-title">Le Nostre Tariffe</h1>
                <p class="dashboard-subtitle">
                    Scegli il pacchetto ingressi per i corsi di gruppo oppure consulta il tariffario dedicato di ogni istruttore per le lezioni individuali 1-to-1.
                </p>
            </div>
            <div class="flex-shrink-0">
                {if isset($utente_loggato) && $ruolo_loggato == 'allievo'}
                    <a href="index.php?controller=prenotazione&action=calendario" class="btn btn-primary dashboard-cta-btn w-100">
                        Vai al Calendario
                    </a>
                {elseif !isset($utente_loggato)}
                    <a href="index.php?controller=utente&action=login" class="btn btn-primary dashboard-cta-btn w-100">
                        Accedi per Prenotare
                    </a>
                {/if}
            </div>
        </div>
    </section>

    <!-- SEZIONE 1: CORSI DI GRUPPO E PACCHETTI -->
    <section class="dashboard-card mb-4">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 pb-3 mb-4 border-bottom">
            <div>
                <h2 class="dashboard-section-title mb-1">Corsi di Gruppo &amp; Pacchetti</h2>
                <p class="dashboard-subtitle" style="font-size: 14.5px;">
                    Miniclassi Reformer e Matwork gestite tramite crediti sul tuo profilo allievo.
                </p>
            </div>
            <span class="dashboard-count-badge">Ingressi a crediti</span>
        </div>

        <div class="row g-4 align-items-stretch">
            <!-- Lezione Singola -->
            <div class="col-12 col-md-6">
                <article class="tariffe-card h-100 d-flex flex-column">
                    <span class="tariffe-pill mb-3">Ingresso Singolo</span>
                    <h3 class="tariffe-card-title">Lezione Singola</h3>
                    <div class="tariffe-price my-3">
                        <span class="tariffe-price-val">20 &euro;</span>
                        <span class="tariffe-price-unit">/ 1 ingresso</span>
                    </div>
                    <p class="tariffe-card-desc">
                        Ideale per provare il Metodo Essenza e conoscere le nostre sale e attrezzature.
                    </p>
                    <ul class="tariffe-features mt-auto pt-3">
                        <li>Valido per Reformer o Matwork</li>
                        <li>Nessun vincolo di rinnovo</li>
                        <li>Disdetta gratuita con riaccredito</li>
                    </ul>
                </article>
            </div>

            <!-- Pacchetto 10 Ingressi (Featured) -->
            <div class="col-12 col-md-6">
                <article class="tariffe-card is-featured h-100 d-flex flex-column">
                    <span class="tariffe-pill is-accent mb-3">Più scelto</span>
                    <h3 class="tariffe-card-title">Pacchetto 10 Ingressi</h3>
                    <div class="tariffe-price my-3">
                        <span class="tariffe-price-val">180 &euro;</span>
                        <span class="tariffe-price-unit">/ 10 ingressi (18 &euro;/lez.)</span>
                    </div>
                    <p class="tariffe-card-desc">
                        La formula più conveniente per allenarti con continuità nei nostri corsi di gruppo.
                    </p>
                    <ul class="tariffe-features mt-auto pt-3">
                        <li>10 crediti subito attivi sul profilo</li>
                        <li>Validità 3 mesi dall'attivazione</li>
                        <li>Prenotazione flessibile dal calendario</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <!-- SEZIONE 2: TARIFFARIO LEZIONI INDIVIDUALI PER ISTRUTTORE (DINAMICO DAL DB) -->
    <section class="dashboard-card mb-4">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 pb-3 mb-4 border-bottom">
            <div>
                <h2 class="dashboard-section-title mb-1">Lezioni Individuali (1-to-1) &mdash; I Nostri Istruttori</h2>
                <p class="dashboard-subtitle" style="font-size: 14.5px;">
                    Sessioni personalizzate da 60 minuti con pagamento separato.
                </p>
            </div>
            <span class="dashboard-count-badge">Pagamento separato &bull; 60 min</span>
        </div>

        {if empty($istruttori_tariffe)}
            <div class="dashboard-empty">
                <p class="dashboard-empty-title">Tariffario istruttori in aggiornamento</p>
                <p class="dashboard-empty-text">
                    Contatta la segreteria per conoscere disponibilità e costi delle lezioni individuali 1-to-1.
                </p>
            </div>
        {else}
            <div class="row g-4 align-items-stretch">
                {foreach $istruttori_tariffe as $istr}
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="tariffe-istruttore-card h-100 d-flex flex-column text-center">
                            <div class="avatar-istruttore mx-auto mb-3">
                                {if !empty($istr.immagine_profilo)}
                                    <img src="/studio-essenza/{$istr.immagine_profilo|escape}" alt="{$istr.nome|escape} {$istr.cognome|escape}">
                                {else}
                                    {$istr.iniziali|escape}
                                {/if}
                            </div>

                            <h3 class="tariffe-card-title mb-1">{$istr.nome|escape} {$istr.cognome|escape}</h3>
                            <span class="dashboard-count-badge mx-auto mb-3">Istruttore Certificato</span>

                            {if !empty($istr.descrizione)}
                                <p class="tariffe-card-desc mb-3">{$istr.descrizione|escape|nl2br}</p>
                            {/if}

                            <div class="tariffe-istruttore-pricebox mt-auto">
                                {if !empty($istr.tariffa_formattata)}
                                    <div class="tariffe-istruttore-amount">{$istr.tariffa_formattata|escape}</div>
                                    <span class="tariffe-istruttore-sub">per lezione individuale (60 min)</span>
                                {else}
                                    <div class="tariffe-istruttore-amount is-muted">Su richiesta</div>
                                    <span class="tariffe-istruttore-sub">Tariffa da concordare in studio</span>
                                {/if}
                            </div>
                        </article>
                    </div>
                {/foreach}
            </div>
        {/if}
    </section>

    <!-- Nota Pagamenti -->
    <div class="tariffe-payment-note d-flex align-items-start gap-3">
        <div class="tariffe-note-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
        </div>
        <div>
            <strong>Modalità di pagamento e attivazione:</strong>
            L'attivazione dei pacchetti ingressi per i corsi di gruppo avviene presso la segreteria dello studio (contanti o POS).
            Le lezioni individuali 1-to-1 non scalano crediti dal pacchetto e vengono saldate separatamente secondo la tariffa indicata dall'istruttore scelto.
        </div>
    </div>

</div>
{/block}
