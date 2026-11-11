<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titolo_pagina|default:'Studio Essenza - Pilates Boutique'}</title>

    <!-- Link al file CSS (creeremo il file general.css tra poco) -->
    <link rel="stylesheet" href="Smarty/css/general.css">
</head>
<body>

    <!-- HEADER E MENU DI NAVIGAZIONE -->
    <header class="main-header">
        <div class="logo">
            <a href="index.php?controller=utente&action=home">Studio Essenza</a>
        </div>
        <nav class="main-menu">
            <ul>
                <li><a href="index.php?controller=utente&action=home">Home</a></li>
                <li><a href="index.php?controller=info&action=metodo">Il Metodo</a></li>
                <li><a href="index.php?controller=info&action=tariffe">Tariffe</a></li>
                <li><a href="index.php?controller=info&action=contatti">Contatti</a></li>

                <!-- Mostriamo link diversi se l'utente è loggato o meno -->
                {if isset($utente_loggato)}
                    <li><a href="index.php?controller=utente&action=dashboard" class="btn-login">La mia Dashboard</a></li>
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

</body>
</html>
