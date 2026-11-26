<!-- File: Smarty/templates/contatti.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #7b8b6f;">Contattaci</h1>
        <p class="sottotitolo">Passa in studio per conoscere gli istruttori o scrivici per prenotare una lezione di prova.</p>
    </div>

    <div style="display: flex; gap: 30px; flex-wrap: wrap; justify-content: center;">
        
        <!-- Recapiti dello Studio -->
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); flex: 1; min-width: 280px;">
            <h3 style="color: #7b8b6f; margin-top: 0;">Dove siamo</h3>
            <p><strong>Indirizzo:</strong> Via del Benessere 12, 00100 Roma</p>
            <p><strong>Telefono:</strong> +39 06 1234567</p>
            <p><strong>Email:</strong> info@studioessenza.it</p>
            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
            <h3 style="color: #7b8b6f;">Orari Segreteria</h3>
            <p>Lunedì - Venerdì: 08:30 - 20:30</p>
            <p>Sabato: 09:00 - 13:00</p>
        </div>

        <!-- Form di Contatto -->
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); flex: 1; min-width: 280px;">
            <h3 style="color: #7b8b6f; margin-top: 0;">Scrivici un messaggio</h3>
            
            {if isset($conferma)}
                <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {$conferma}
                </div>
            {/if}

            {if isset($errore)}
                <div class="auth-alert-error d-flex align-items-start gap-2 mb-3" role="alert">
                    <span>{$errore|escape}</span>
                </div>
            {/if}

            <form action="index.php?controller=info&action=contatti" method="POST" class="auth-form">
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="nome" style="display:block; margin-bottom:5px;">Il tuo Nome</label>
                    <input type="text" id="nome" name="nome" required data-msg-required="Inserisci il tuo nome." style="width:100%; padding:8px; box-sizing:border-box;">
                </div>
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="email" style="display:block; margin-bottom:5px;">La tua Email</label>
                    <input type="email" id="email" name="email" required data-msg-required="Inserisci il tuo indirizzo email." data-msg-type="Inserisci un indirizzo email valido (es. nome@esempio.it)." style="width:100%; padding:8px; box-sizing:border-box;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="messaggio" style="display:block; margin-bottom:5px;">Messaggio</label>
                    <textarea id="messaggio" name="messaggio" rows="4" required data-msg-required="Scrivi il messaggio che desideri inviarci." style="width:100%; padding:8px; box-sizing:border-box;"></textarea>
                </div>
                
                <button type="submit" class="btn-primary" style="background-color: #7b8b6f; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Invia Messaggio</button>
            </form>
        </div>

    </div>
</div>
{/block}