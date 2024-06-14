<?php
class Evento {
    private $id;
    private $titulo;
    private $docente;
    private $oferta; 

    public function __construct($id, $titulo, $docente, $oferta) {
        $this->id = $id;
        $this->titulo = $titulo;
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

    public function setDocente($docente) {
        $this->docente = $docente;
    }

    public function setOferta($oferta) {
        $this->oferta = $oferta;
    }
}
?>
