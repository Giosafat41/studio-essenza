<?php

class ELezione {
    
    private $id;
    private $id_corso;
    private $id_istruttore;
    private $data_ora_inizio;
    private $data_ora_fine;
    private $durata_minuti;

    public function __construct($id_corso, $id_istruttore, $data_ora_inizio, $data_ora_fine = null, $durata_minuti = null) {
        $this->id_corso = $id_corso;
        $this->id_istruttore = $id_istruttore;
        $this->data_ora_inizio = $data_ora_inizio;

        if ($durata_minuti !== null) {
            $this->durata_minuti = (int)$durata_minuti;
            $this->data_ora_fine = $data_ora_fine
                ? $data_ora_fine
                : date('Y-m-d H:i:s', strtotime($data_ora_inizio . " +{$this->durata_minuti} minutes"));
        } elseif ($data_ora_fine !== null) {
            $this->data_ora_fine = $data_ora_fine;
            $diff = (int)round((strtotime($data_ora_fine) - strtotime($data_ora_inizio)) / 60);
            $this->durata_minuti = $diff > 0 ? $diff : 60;
        } else {
            $this->durata_minuti = 60;
            $this->data_ora_fine = date('Y-m-d H:i:s', strtotime($data_ora_inizio . ' +60 minutes'));
        }
    }

    // --- GETTER ---
    public function getId() { return $this->id; }
    public function getIdCorso() { return $this->id_corso; }
    public function getIdIstruttore() { return $this->id_istruttore; }
    public function getDataOraInizio() { return $this->data_ora_inizio; }
    public function getDataOraFine() { return $this->data_ora_fine; }
    public function getDurataMinuti() { return $this->durata_minuti; }

    // --- SETTER ---
    public function setId($id) { $this->id = $id; }
    public function setIdCorso($id_corso) { $this->id_corso = $id_corso; }
    public function setIdIstruttore($id_istruttore) { $this->id_istruttore = $id_istruttore; }
    public function setDataOraInizio($data_ora_inizio) { $this->data_ora_inizio = $data_ora_inizio; }
    public function setDataOraFine($data_ora_fine) { $this->data_ora_fine = $data_ora_fine; }
    public function setDurataMinuti($durata_minuti) { $this->durata_minuti = (int)$durata_minuti; }
}
?>