<?php
    
    include_once "../config/Database.php";
    include_once "../entity/Evento.php";
    //require_once "../config/Database.php";
    //require_once "../entity/Evento.php";

    class EventoDAO implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM evento WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $evento = $stmt->fetch(PDO::FETCH_ASSOC);

                return $evento ?
                    new Evento($evento['id'],
                                $evento['titulo'],
                                $evento['docente'],
                                $evento['oferta'])
                    : null;

            } catch (PDOException $e) {
                return false;
            }
        }

        public function getAll() {
            try {
                $sql = "SELECT * FROM reserva";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($evento) {
                    return new Evento($evento['id'],
                                        $evento['titulo'],
                                        $evento['docente'],
                                        $evento['oferta']);
                                    }, $eventos);
            } catch (PDOException $e) {
                return false;
            }
        }

        public function create($evento) {
            try {
            $sql = "INSERT INTO evento (titulo, docente, oferta) VALUES
                (:titulo, :docente, :oferta)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $titulo = $evento->getTitulo();
                $docente = $evento->getDocente();
                $oferta = $evento->getOferta();
                
                $stmt->bindParam(':titulo', $titulo);
                $stmt->bindParam(':docente', $docente);
                $stmt->bindParam(':oferta', $oferta);
                
                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($evento) {
            try {
                $existingEvento = $this->getById($evento->getId());
                if(!$existingEvento) {
                    return false; // Retorna falso se o usuário não existir
                }
                
                $sql = "UPDATE evento SET titulo = :titulo, docente = :docente, oferta = :oferta WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $evento->getId();
                $titulo = $evento->getTitulo();
                $docente = $evento->getDocente();
                $oferta = $evento->getOferta();
                
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':titulo', $titulo);
                $stmt->bindParam(':docente', $docente);
                $stmt->bindParam(':oferta', $oferta);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }

        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM evento WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

    }

