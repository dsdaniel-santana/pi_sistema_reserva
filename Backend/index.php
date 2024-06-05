<?php
require_once "config/Database.php";
require_once "dao/EventoDAO.php";
require_once "entity/Evento.php";
require_once "dao/TipoDAO.php";

$tipoDAO = new TipoDAO();
$tipo = new Tipo(2, "Lab. Enfermagem");
print_r($tipoDAO->delete(3));

?>

<link rel="stylesheet" href="../pi_sistema_reserva/Frontend/css/style.css">
