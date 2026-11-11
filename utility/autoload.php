<?php
function my_autoloader($classname) {
    // Definiamo le cartelle in cui cercare le classi
    $directories = array(
        'Entity/',
        'Foundation/',
        'Controller/',
        'View/',
        'utility/',
        'Smarty/'
    );

    // Cicliamo su ogni cartella per verificare se il file della classe esiste
    foreach ($directories as $dir) {
        $file = $dir . $classname . '.php';
        if (file_exists($file)) {
            require_once($file);
            return;
        }
    }
}

// Registriamo la funzione come autoloader ufficiale di PHP
spl_autoload_register('my_autoloader');
?>