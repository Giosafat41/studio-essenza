<?php
// File: Entity/ELezioneIndividuale.php

class ELezioneIndividuale {
    private $id;
    private $id_istruttore;
    private $id_utente;
    private $data_ora_inizio;
    private $data_ora_fine;
    private $stato; // 'disponibile', 'prenotata', 'annullata_istruttore'
    private $motivazione_annullamento;

    public function __construct(
        $id_istruttore,
        $data_ora_inizio,
        $data_ora_fine = null,
        $id_utente = null,
        $stato = 'disponibile',
        $motivazione_annullamento = null
    ) {
        $this->id_istruttore = (int)$id_istruttore;
        $this->data_ora_inizio = $data_ora_inizio;
        // Durata standard di 1 ora se non specificata
        $this->data_ora_fine = $data_ora_fine
            ? $data_ora_fine
            : date('Y-m-d H:i:s', strtotime($data_ora_inizio . ' +1 hour'));
        $this->id_utente = $id_utente !== null ? (int)$id_utente : null;
        $this->stato = $stato;
        $this->motivazione_annullamento = $motivazione_annullamento;
    }

    // --- GETTER ---
    public function getId() { return $this->id; }
    public function getIdIstruttore() { return $this->id_istruttore; }
    public function getIdUtente() { return $this->id_utente; }
    public function getDataOraInizio() { return $this->data_ora_inizio; }
    public function getDataOraFine() { return $this->data_ora_fine; }
    public function getStato() { return $this->stato; }
    public function getMotivazioneAnnullamento() { return $this->motivazione_annullamento; }

    // --- SETTER ---
    public function setId($id) { $this->id = (int)$id; }
    public function setIdUtente($id_utente) { $this->id_utente = $id_utente !== null ? (int)$id_utente : null; }
    public function setStato($stato) { $this->stato = $stato; }
    public function setMotivazioneAnnullamento($motivazione) { $this->motivazione_annullamento = $motivazione; }
}
?>