<?php

class EUtente {
    
    private $id;
    private $nome;
    private $cognome;
    private $email;
    private $password;
    private $telefono;
    private $ruolo;
    private $crediti_residui;
    private $scadenza_certificato;
    private $data_registrazione;

    // ID e data di registrazione vengono generati dal DB
    public function __construct($nome, $cognome, $email, $password, $telefono = null, $ruolo = 'allievo', $crediti_residui = 0, $scadenza_certificato = null) {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = $password;
        $this->telefono = $telefono;
        $this->ruolo = $ruolo;
        $this->crediti_residui = $crediti_residui;
        $this->scadenza_certificato = $scadenza_certificato;
    }

    // --- GETTER METODI ---
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCognome() { return $this->cognome; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getTelefono() { return $this->telefono; }
    public function getRuolo() { return $this->ruolo; }
    public function getCreditiResidui() { return $this->crediti_residui; }
    public function getScadenzaCertificato() { return $this->scadenza_certificato; }
    public function getDataRegistrazione() { return $this->data_registrazione; }
    // --- SETTER METODI ---
    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setCognome($cognome) { $this->cognome = $cognome; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setRuolo($ruolo) { $this->ruolo = $ruolo; }
    public function setCreditiResidui($crediti_residui) { $this->crediti_residui = $crediti_residui; }
    public function setScadenzaCertificato($scadenza_certificato) { $this->scadenza_certificato = $scadenza_certificato; }
    public function setDataRegistrazione($data_registrazione) { $this->data_registrazione = $data_registrazione; }

    // --- METODI DI LOGICA AGGIUNTIVA ---
    
    // Metodo utile per scalare un credito quando l'allievo prenota una lezione
    public function scalaCredito() {
        if ($this->crediti_residui > 0) {
            $this->crediti_residui--;
            return true;
        }
        return false;
    }

    // Metodo per ricaricare i crediti (usato dalla segreteria)
    public function ricaricaCrediti($quantita) {
        $this->crediti_residui += $quantita;
    }
}
?>