<!-- File: Smarty/templates/errore.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="form-container" style="text-align: center;">
    <h2>Ops, qualcosa è andato storto!</h2>
    <div class="alert-error" style="margin: 20px 0;">
        {$errore}
    </div>
    <a href="index.php?controller=utente&action=dashboard" class="btn-primary">Torna alla tua Dashboard</a>
</div>
{/block}