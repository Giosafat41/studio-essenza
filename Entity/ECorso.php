<?php

class ECorso {
    
    private $id;
    private $nome;
    private $descrizione;
    private $capienza_max;

    public function __construct($nome, $descrizione, $capienza_max) {
        $this->nome = $nome;
        $this->descrizione = $descrizione;
        $this->capienza_max = $capienza_max;
    }

    // --- GETTER ---
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getDescrizione() { return $this->descrizione; }
    public function getCapienzaMax() { return $this->capienza_max; }

    // --- SETTER ---
    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setDescrizione($descrizione) { $this->descrizione = $descrizione; }
    public function setCapienzaMax($capienza_max) { $this->capienza_max = $capienza_max; }
}
?>