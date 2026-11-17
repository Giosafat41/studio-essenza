<!-- File: Smarty/templates/admin_dashboard.tpl -->
{extends file="layout.tpl"}

{block name="content"}
<div class="dashboard-container">
    <header class="header-boutique" style="background-color: #e9ecef;">
        <h1>Pannello Segreteria</h1>
        <p>Benvenuto/a, {$nome_admin} (Amministratore)</p>
    </header>

    <div class="grid-tariffe" style="margin-top: 30px;">
        
        <!-- Blocco 1: Gestione Crediti -->
        <div class="card-tariffa">
            <h3>Ricarica Crediti</h3>
            <p class="desc">Aggiungi ingressi al profilo di un allievo dopo il pagamento in sede.</p>
            <br>
            <a href="index.php?controller=admin&action=ricaricaCrediti" class="btn-primary">Vai alla Ricarica</a>
        </div>
        
        <!-- Blocco 2: Gestione Calendario -->
        <div class="card-tariffa premium">
            <h3>Gestione Palinsesto</h3>
            <p class="desc">Inserisci nuove lezioni a calendario scegliendo corso, orario e istruttore.</p>
            <br>
            <a href="index.php?controller=admin&action=aggiungiLezione" class="btn-primary" style="background-color: #7b8b6f; color:white;">Nuova Lezione</a>
        </div>

        <!-- Blocco 3: Appello -->
        <div class="card-tariffa">
            <h3>Registro Appello</h3>
            <p class="desc">Controlla la lista degli iscritti (inserisci l'ID della lezione).</p>
            <br>
            <form action="index.php" method="GET" style="display:flex; gap:10px; justify-content:center;">
                <input type="hidden" name="controller" value="admin">
                <input type="hidden" name="action" value="appello">
                <input type="number" name="id_lezione" placeholder="ID Lez." required style="width:70px; padding:5px;">
                <button type="submit" class="btn-primary" style="padding: 5px 10px;">Cerca</button>
            </form>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <a href="index.php?controller=utente&action=logout" style="color: #d9534f; text-decoration: none; font-weight: bold;">Esci dall'account Admin</a>
    </div>
</div>
{/block}