<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo_pagina|default:'Studio Essenza - Pilates Boutique'}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/studio-essenza/css/general.css">
</head>
<body>

    <!-- HEADER E MENU DI NAVIGAZIONE -->
    <header class="main-header">
        <div class="logo">
            <a href="index.php?controller=utente&action=home">
                <img src="/studio-essenza/doc/img/logo.png" alt="Studio Essenza">
            </a>
        </div>
        <nav class="main-menu">
            <ul>
                <li><a href="index.php?controller=utente&action=home">Home</a></li>
                <li><a href="index.php?controller=info&action=metodo">Il Metodo</a></li>
                <li><a href="index.php?controller=info&action=tariffe">Tariffe</a></li>
                <li><a href="index.php?controller=info&action=contatti">Contatti</a></li>
                
                {if isset($utente_loggato)}
                    {if $ruolo_loggato == 'admin'}
                        <li><a href="index.php?controller=admin&action=dashboard" class="btn-login">Pannello Segreteria</a></li>
                    {elseif $ruolo_loggato == 'istruttore'}
                        <li><a href="index.php?controller=istruttore&action=dashboard" class="btn-login">Area Istruttore</a></li>
                    {else}
                        <li><a href="index.php?controller=utente&action=dashboard" class="btn-login">La mia Dashboard</a></li>
                    {/if}
                    <li><a href="index.php?controller=utente&action=logout" style="color: #d9534f;">Esci</a></li>
                {else}
                    <li><a href="index.php?controller=utente&action=login" class="btn-login">Accedi / Registrati</a></li>
                {/if}
            </ul>
        </nav>
    </header>

    <!-- CONTENUTO DINAMICO: Qui verranno inserite le pagine specifiche -->
    <main class="main-content">
        {block name="content"}{/block}
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        <p>&copy; 2024 Studio Essenza Pilates. Tutti i diritti riservati.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
