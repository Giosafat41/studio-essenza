<?php

class EPrenotazione {
    
    private $id;
    private $id_utente;
    private $id_lezione;
    private $data_prenotazione;
    private $stato_presenza;

    public function __construct($id_utente, $id_lezione, $stato_presenza = 'da_effettuare') {
        $this->id_utente = $id_utente;
        $this->id_lezione = $id_lezione;
        $this->stato_presenza = $stato_presenza;
        // L'id e la data_prenotazione sono generati dal DB
    }

    // --- GETTER ---
    public function getId() { return $this->id; }
    public function getIdUtente() { return $this->id_utente; }
    public function getIdLezione() { return $this->id_lezione; }
    public function getDataPrenotazione() { return $this->data_prenotazione; }
    public function getStatoPresenza() { return $this->stato_presenza; }

    // --- SETTER ---
    public function setId($id) { $this->id = $id; }
    public function setIdUtente($id_utente) { $this->id_utente = $id_utente; }
    public function setIdLezione($id_lezione) { $this->id_lezione = $id_lezione; }
    public function setDataPrenotazione($data_prenotazione) { $this->data_prenotazione = $data_prenotazione; }
    public function setStatoPresenza($stato_presenza) { $this->stato_presenza = $stato_presenza; }
}
?>