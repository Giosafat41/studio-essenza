<?php
// 1. Includiamo l'autoloader per caricare automaticamente tutte le classi
require_once('utility/autoload.php');

// 2. (Opzionale ma raccomandato) Avviamo la sessione per gestire i login in futuro
session_start();

// 3. Istanziamo il Front Controller e avviamo il routing
$frontController = new CFrontController();
$frontController->run();

?>