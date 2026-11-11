<!-- File: Smarty/templates/registrazione.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container">
    <h2>Nuovo Allievo</h2>
    <p class="sottotitolo">Crea un account per gestire le tue prenotazioni.</p>
    
    {if isset($errore)}
        <div class="alert-error">{$errore}</div>
    {/if}

    <form action="index.php?controller=utente&action=registra" method="POST" class="auth-form">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        
        <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" required>
        </div>

        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="tel" id="telefono" name="telefono">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn-primary">Registrati</button>
    </form>
    
    <p class="form-footer">Sei già iscritto? <a href="index.php?controller=utente&action=login">Accedi qui</a>.</p>
</div>
{/block}