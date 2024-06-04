<?php
    class Sala {
        private $id;
        private $numero;
        private $capacidade;
        private $andar;
        private $tipo;
        
        
        public function __construct($id, $numero, $capacidade, $andar, $tipo,) {
            $this->id = $id;
            $this->numero = $numero;
            $this->capacidade = $capacidade;
            $this->andar;
            $this->tipo = $tipo;
            
            
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function getAndar() {
            return $this->andar;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getCapacidade() {
            return $this->capacidade;
        }

        // SETTERS
    }
?>