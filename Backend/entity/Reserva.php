<?php
    class Reserva {
        private $id;
        private $status_sala;
        private $data_inicio;
        private $data_fim; 
        private $horario_inicio; 
        private $horario_fim; 
        private $dias_semana; 
        private $evento_id;   
        private $sala_id;
        
        public function __construct($id, $status_sala, $data_inicio, $data_fim, $horario_inicio, $horario_fim, $dias_semana, $evento_id, $sala_id)
        {
            $this->id = $id;
            $this->status_sala = $status_sala;
            $this->data_inicio = $data_inicio;
            $this->data_fim = $data_fim;
            $this->horario_inicio = $horario_inicio;
            $this->horario_fim = $horario_fim;
            $this->dias_semana = $dias_semana;
            $this->evento_id = $evento_id;
            $this->sala_id = $sala_id;
        }

        // GETTERS

        public function getId() {
            return $this->id;
        }

        public function getStatus_sala() {
            return $this->status_sala;
        }

        public function getData_inicio() {
            return $this->data_inicio;
        }

        public function getData_fim() {
            return $this->data_fim;
        }

        public function getHorario_inicio() {
            return $this->horario_inicio;
        }

        public function getHoraio_fim() {
            return $this->horario_fim;
        }

        public function getDias_semana() {
            return $this->dias_semana;
        }

        public function getEvento_id() {
            return $this->evento_id;
        }

        public function getSala_id() {
            return $this->sala_id;
        }
    }
?>