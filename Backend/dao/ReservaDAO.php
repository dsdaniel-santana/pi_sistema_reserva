<?php
    require_once "Backend/config/Database.php";
    require_once "BaseDAO.php";
    require_once "Backend/entity/Reserva.php";

    class ReservaDAO implements BaseDAO {
        private $db;

        public function __construct() {
            $this->db = Database::getInstance();
        }

        public function getById($id) {
            try {
                $sql = "SELECT * FROM reserva WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();

                $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

                return $reserva ?
                    new Reserva($reserva['id'],
                                $reserva['status_sala'],
                                $reserva['data_inicio'],
                                $reserva['data_fim'],
                                $reserva['horario_inicio'],
                                $reserva['horario_fim'],
                                $reserva['dias_semana'],
                                $reserva['evento_ID'],
                                $reserva['sala_ID'])
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

                $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($reserva) {
                    return new Reserva($reserva['id'],
                                        $reserva['status_sala'],
                                        $reserva['data_inicio'],
                                        $reserva['data_fim'],
                                        $reserva['horario_inicio'],
                                        $reserva['horario_fim'],
                                        $reserva['dias_semana'],
                                        $reserva['evento_ID'],
                                        $reserva['sala_ID']);
                                    }, $reservas);
            } catch (PDOException $e) {
                return false;
            }
        }

        public function create($reserva) {
            try {
                $sql = "INSERT INTO reserva (status_sala, data_inicio, data_fim, horario_inicio, horario_fim, dias_semana,evento_ID, sala_ID) VALUES
                (:status_sala, :data_inicio, :data_fim, :horario_inicio, :horario_fim, :dias_semana, :evento_ID, :sala_ID)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $status_sala = $reserva->getStatus_sala();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $horario_inicio = $reserva->getHorario_inicio();
                $horario_fim = $reserva->getHoraio_fim();
                $dias_semana = $reserva->getDias_semana();
                $evento_ID = $reserva->getEvento_id();
                $sala_ID = $reserva->getSala_id();

                $stmt->bindParam(':status_sala', $status_sala);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);
                $stmt->bindParam(':dias_semana', $dias_semana);
                $stmt->bindParam(':evento_ID', $evento_ID);
                $stmt->bindParam(':sala_ID', $sala_ID);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return false;
            }
        }

        public function update($reserva) {
            try {
                $existingReserva = $this->getById($reserva->getId());
                if(!$existingReserva) {
                    return false; // Retorna falso se o usuário não existir
                }
                
                $sql = "UPDATE reserva SET status_sala = :status_sala, data_inicio = :data_inicio, data_fim = :data_fim, horario_inicio = :horario_inicio, 
                horario_fim = :horario_fim, dias_semana = :dias_semana, evento_ID = :evento_ID, sala_ID = :sala_ID
                WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $reserva->getId();
                $status_sala = $reserva->getStatus_sala();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $horario_inicio = $reserva->getHorario_inicio();
                $horario_fim = $reserva->getHoraio_fim();
                $dias_semana = $reserva->getDias_semana();
                $evento_ID = $reserva->getEvento_id();
                $sala_ID = $reserva->getSala_id();

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':status_sala', $status_sala);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);
                $stmt->bindParam(':dias_semana', $dias_semana);
                $stmt->bindParam(':evento_ID', $evento_ID);
                $stmt->bindParam(':sala_ID', $sala_ID);

                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                return $e;
            }
        }

        public function delete($id) {
            try {
                $sql = "DELETE FROM reserva WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
           
            } catch (PDOException $e) {
                return false;
            }
        }

        public function listarSalas($id) {
            try {
                $sql = "SELECT sala.numero, evento.titulo, reserva.horario_inicio, reserva.horario_fim, evento.docente FROM reserva 
                        LEFT JOIN sala on reserva.sala_ID = sala.id
                        LEFT JOIN evento on evento_ID = evento.id
                        WHERE sala_id = :id";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

               return $reservas;
            } catch(PDOException $e) {
                return false;
            }
        }

        public function getValidacaoParaCriacao($entity) {
            try {
                $sql = "";
            } catch(PDOException $e) {
                return false;
            }
        }

        // Adicionando a função isConflict para verificar conflitos de reserva
        public function isConflict($data_inicio, $data_fim, $horario_inicio, $horario_fim, $sala_id) {
            try {
                $sql = "SELECT COUNT(*) FROM reserva WHERE sala_ID = :sala_id AND 
                        (data_inicio <= :data_fim AND data_fim >= :data_inicio) AND 
                        (horario_inicio < :horario_fim AND horario_fim > :horario_inicio)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':sala_id', $sala_id, PDO::PARAM_INT);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                return $count > 0;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
