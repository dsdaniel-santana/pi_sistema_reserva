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
                                $reserva['docente'],
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
                                        $reserva['docente'],
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


        public function getbyEvento_id($evento_ID) {
            try {
                $sql = "SELECT * FROM reserva WHERE evento_ID = :evento_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':evento_id', $evento_ID);
                $stmt->execute();

                $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function ($reserva) {
                    return new Reserva($reserva['id'],
                                        $reserva['docente'],
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
                $sql = "INSERT INTO reserva (docente, data_inicio, data_fim, horario_inicio, horario_fim, dias_semana,evento_ID, sala_ID) VALUES
                (:docente, :data_inicio, :data_fim, :horario_inicio, :horario_fim, :dias_semana, :evento_ID, :sala_ID)";

                $stmt = $this->db->prepare($sql);

                // Bind parameters by reference
                $docente = $reserva->getDocente();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $horario_inicio = $reserva->getHorario_inicio();
                $horario_fim = $reserva->getHoraio_fim();
                $dias_semana = $reserva->getDias_semana();
                $evento_ID = $reserva->getEvento_id();
                $sala_ID = $reserva->getSala_id();

                $stmt->bindParam(':docente', $docente);
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
                
                $sql = "UPDATE reserva SET docente = :docente, data_inicio = :data_inicio, data_fim = :data_fim, horario_inicio = :horario_inicio, 
                horario_fim = :horario_fim, dias_semana = :dias_semana, evento_ID = :evento_ID, sala_ID = :sala_ID
                WHERE id = :id";
                
                $stmt = $this->db->prepare($sql);
                // Bind parameters by reference
                $id = $reserva->getId();
                $docente = $reserva->getDocente();
                $data_inicio = $reserva->getData_inicio();
                $data_fim = $reserva->getData_fim();
                $horario_inicio = $reserva->getHorario_inicio();
                $horario_fim = $reserva->getHoraio_fim();
                $dias_semana = $reserva->getDias_semana();
                $evento_ID = $reserva->getEvento_id();
                $sala_ID = $reserva->getSala_id();

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':docente', $docente);
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

        public function listarSalas($data, $horario_inicio, $horario_fim, $dia_semana) {
            try {
                // Ajustar a consulta SQL
                $sql = "SELECT sala.numero, evento.titulo, reserva.horario_inicio, reserva.horario_fim, reserva.docente 
                        FROM reserva 
                        LEFT JOIN sala ON reserva.sala_ID = sala.id
                        LEFT JOIN evento ON reserva.evento_ID = evento.id
                        WHERE :data BETWEEN reserva.data_inicio AND reserva.data_fim
                          AND (:horario_inicio BETWEEN reserva.horario_inicio AND reserva.horario_fim
                               OR :horario_fim BETWEEN reserva.horario_inicio AND reserva.horario_fim
                               OR (reserva.horario_inicio >= :horario_inicio AND reserva.horario_fim <= :horario_fim))
                          AND reserva.dias_semana LIKE :dia_semana
                        ORDER BY sala.numero ASC";
        
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':data', $data);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);
        
                // Adicionar curingas '%' ao redor do valor do dia da semana para a cláusula LIKE
                $dia_semana_param = '%' . $dia_semana . '%';
                $stmt->bindParam(':dia_semana', $dia_semana_param);
        
                $stmt->execute();
                $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                return $reservas;
            } catch (PDOException $e) {
                return false;
            }
        }
        
        

        public function isConflict($data_inicio, $data_fim, $horario_inicio, $horario_fim, $sala_id, $dias_semana) {
            try {
                // Construindo a query SQL dinamicamente com base nos dias da semana fornecidos
                $sql = "SELECT COUNT(*) FROM reserva 
                        WHERE sala_ID = :sala_id 
                        AND (data_inicio <= :data_fim AND data_fim >= :data_inicio) 
                        AND (horario_inicio < :horario_fim AND horario_fim > :horario_inicio)
                        AND (";

                // Montando a condição para cada dia da semana
                $dias_array = explode(',', $dias_semana);
                $param_count = count($dias_array);
                for ($i = 0; $i < $param_count; $i++) {
                    if ($i > 0) {
                        $sql .= " OR ";
                    }
                    $sql .= "FIND_IN_SET(:dia$i, dias_semana) > 0";
                }
                $sql .= ")";

                // Preparando a statement
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':sala_id', $sala_id, PDO::PARAM_INT);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);

                // Vinculando os dias da semana dinâmicos
                for ($i = 0; $i < $param_count; $i++) {
                    $stmt->bindParam(":dia$i", $dias_array[$i], PDO::PARAM_INT);
                }

                // Executando a query e recuperando o resultado
                $stmt->execute();
                $count = $stmt->fetchColumn();
                return $count > 0;
            } catch (PDOException $e) {
                return false;
            }
        }

        
        

        public function getConflictingReservations($data_inicio, $data_fim, $horario_inicio, $horario_fim, $sala_id, $dias_semana) {
            try {
                // Construindo a query SQL dinamicamente com base nos dias da semana fornecidos
                $sql = "SELECT * FROM reserva 
                        WHERE sala_ID = :sala_id 
                        AND (data_inicio <= :data_fim AND data_fim >= :data_inicio) 
                        AND (horario_inicio < :horario_fim AND horario_fim > :horario_inicio)
                        AND (";

                // Montando a condição para cada dia da semana
                $dias_array = explode(',', $dias_semana);
                $param_count = count($dias_array);
                for ($i = 0; $i < $param_count; $i++) {
                    if ($i > 0) {
                        $sql .= " OR ";
                    }
                    $sql .= "FIND_IN_SET(:dia$i, dias_semana) > 0";
                }
                $sql .= ")";

                // Preparando a statement
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':sala_id', $sala_id, PDO::PARAM_INT);
                $stmt->bindParam(':data_inicio', $data_inicio);
                $stmt->bindParam(':data_fim', $data_fim);
                $stmt->bindParam(':horario_inicio', $horario_inicio);
                $stmt->bindParam(':horario_fim', $horario_fim);

                // Vinculando os dias da semana dinâmicos
                for ($i = 0; $i < $param_count; $i++) {
                    $stmt->bindParam(":dia$i", $dias_array[$i], PDO::PARAM_INT);
                }

                // Executando a query e recuperando o resultado
                $stmt->execute();
                $conflitos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $conflitos;
            } catch (PDOException $e) {
                return [];
            }
        }


    }
        
?>