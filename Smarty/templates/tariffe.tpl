<!-- Diciamo a Smarty di usare il layout base -->
{extends file="layout.tpl"}

<!-- Riempiamo il blocco 'content' -->
{block name="content"}
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
{/block}
