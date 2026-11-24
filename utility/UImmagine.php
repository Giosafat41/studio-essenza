<?php
// File: utility/UImmagine.php

class UImmagine {

    private const DIR_RELATIVA = 'doc/img/profili';
    private const MAX_BYTES = 5242880; // 5 MB
    private const MIME_ESTENSIONI = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
        'image/gif'  => 'gif',
    ];

    // Verifica se è stato effettivamente inviato un file nel campo indicato
    public static function hasUpload(?array $file): bool {
        return isset($file['error']) && $file['error'] !== UPLOAD_ERR_NO_FILE;
    }

    // Valida l'immagine prima del salvataggio e restituisce l'estensione consentita oppure un errore
    public static function validaUpload(?array $file): array {
        if (!$file || !isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return ['ok' => false, 'estensione' => null, 'errore' => 'Seleziona un file immagine da caricare.'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $messaggio = ($file['error'] === UPLOAD_ERR_INI_SIZE || $file['error'] === UPLOAD_ERR_FORM_SIZE)
                ? 'Il file supera la dimensione massima consentita (5 MB).'
                : 'Errore durante il caricamento del file. Riprova.';
            return ['ok' => false, 'estensione' => null, 'errore' => $messaggio];
        }

        if (($file['size'] ?? 0) <= 0 || $file['size'] > self::MAX_BYTES) {
            return ['ok' => false, 'estensione' => null, 'errore' => 'L\'immagine deve essere al massimo di 5 MB.'];
        }

        $tmp = $file['tmp_name'] ?? '';
        if ($tmp === '' || !is_uploaded_file($tmp)) {
            return ['ok' => false, 'estensione' => null, 'errore' => 'Upload non valido.'];
        }

        $info = @getimagesize($tmp);
        if ($info === false || empty($info['mime']) || !isset(self::MIME_ESTENSIONI[$info['mime']])) {
            return ['ok' => false, 'estensione' => null, 'errore' => 'Formato non supportato. Carica un\'immagine JPG, PNG, WEBP o GIF.'];
        }

        return ['ok' => true, 'estensione' => self::MIME_ESTENSIONI[$info['mime']], 'errore' => null];
    }

    // Salva la nuova immagine profilo, elimina l'eventuale precedente e restituisce il percorso relativo
    public static function salvaImmagineProfilo(?array $file, int $userId, ?string $vecchioPercorso = null): array {
        $check = self::validaUpload($file);
        if (!$check['ok']) {
            return ['ok' => false, 'percorso' => null, 'errore' => $check['errore']];
        }

        $rootDir = dirname(__DIR__);
        $destDir = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, self::DIR_RELATIVA);

        if (!is_dir($destDir) && !mkdir($destDir, 0755, true)) {
            return ['ok' => false, 'percorso' => null, 'errore' => 'Impossibile creare la cartella di salvataggio immagini.'];
        }

        $token = bin2hex(random_bytes(4));
        $nomeFile = sprintf('profilo_%d_%d_%s.%s', $userId, time(), $token, $check['estensione']);
        $destAssoluto = $destDir . DIRECTORY_SEPARATOR . $nomeFile;

        if (!move_uploaded_file($file['tmp_name'], $destAssoluto)) {
            return ['ok' => false, 'percorso' => null, 'errore' => 'Impossibile salvare l\'immagine caricata.'];
        }

        if (!empty($vecchioPercorso)) {
            self::eliminaImmagineProfilo($vecchioPercorso);
        }

        return [
            'ok' => true,
            'percorso' => self::DIR_RELATIVA . '/' . $nomeFile,
            'errore' => null,
        ];
    }

    // Elimina in sicurezza un file immagine profilo precedente solo se interno a doc/img/profili
    public static function eliminaImmagineProfilo(?string $percorsoRelativo): void {
        if (empty($percorsoRelativo)) {
            return;
        }

        $normalizzato = str_replace('\\', '/', ltrim($percorsoRelativo, '/'));
        $prefisso = self::DIR_RELATIVA . '/';
        if (strpos($normalizzato, $prefisso) !== 0) {
            return;
        }

        $nomeFile = basename($normalizzato);
        $rootDir = dirname(__DIR__);
        $fileAssoluto = $rootDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, self::DIR_RELATIVA) . DIRECTORY_SEPARATOR . $nomeFile;

        if (is_file($fileAssoluto)) {
            @unlink($fileAssoluto);
        }
    }
}
?>
