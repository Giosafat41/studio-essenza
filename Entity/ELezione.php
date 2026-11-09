<?php

class ELezione {
    
    private $id;
    private $id_corso;
    private $id_istruttore;
    private $data_ora_inizio;
    private $data_ora_fine;

    public function __construct($id_corso, $id_istruttore, $data_ora_inizio, $data_ora_fine) {
        $this->id_corso = $id_corso;
        $this->id_istruttore = $id_istruttore;
        $this->data_ora_inizio = $data_ora_inizio;
        $this->data_ora_fine = $data_ora_fine;
    }

    // --- GETTER ---
    public function getId() { return $this->id; }
    public function getIdCorso() { return $this->id_corso; }
    public function getIdIstruttore() { return $this->id_istruttore; }
    public function getDataOraInizio() { return $this->data_ora_inizio; }
    public function getDataOraFine() { return $this->data_ora_fine; }

    // --- SETTER ---
    public function setId($id) { $this->id = $id; }
    public function setIdCorso($id_corso) { $this->id_corso = $id_corso; }
    public function setIdIstruttore($id_istruttore) { $this->id_istruttore = $id_istruttore; }
    public function setDataOraInizio($data_ora_inizio) { $this->data_ora_inizio = $data_ora_inizio; }
    public function setDataOraFine($data_ora_fine) { $this->data_ora_fine = $data_ora_fine; }
}
?>