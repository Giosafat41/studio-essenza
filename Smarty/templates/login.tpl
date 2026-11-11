<!-- File: Smarty/templates/login.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container">
    <h2>Accedi al tuo profilo</h2>
    
    <!-- Se il Controller passa un errore, Smarty lo mostra qui -->
    {if isset($errore)}
        <div class="alert-error">{$errore}</div>
    {/if}

    <form action="index.php?controller=utente&action=login" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Inserisci la tua email">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Inserisci la tua password">
        </div>
        
        <button type="submit" class="btn-primary">Accedi</button>
    </form>
    
    <p class="form-footer">Non hai ancora un account? <a href="index.php?controller=utente&action=registra">Registrati qui</a>.</p>
</div>
{/block}