<?php
class Evento {
    private $id;
    private $titulo;
    private $sigla;
    private $docente;
    private $oferta;
    private $reservas;

    public function __construct($id, $titulo, $sigla, $docente, $oferta) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->sigla = $sigla;
        $this->docente = $docente;
        $this->oferta = $oferta;
    }

    // GETTERS
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getSigla() {
        return $this->sigla;
    }

    public function getDocente() {
        return $this->docente;
    }

    public function getOferta() {
        return $this->oferta;
    }

    // SETTERS
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    public function setDocente($docente) {
        $this->docente = $docente;
    
    }
    public function setReservas($reservas) {
        $this->reservas = $reservas;
    }

    public function setOferta($oferta) {
        $this->oferta = $oferta;
    }
}
?>
