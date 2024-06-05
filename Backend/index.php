<?php
require_once "config/Database.php";
require_once "dao/EventoDAO.php";
require_once "entity/Evento.php";

$eventoDAO = new EventoDAO();
$evento = new Evento(2, "Técnico em jardinagem", "Aecio", "295689");
echo $eventoDAO->delete(2);

?>

<link rel="stylesheet" href="../pi_sistema_reserva/Frontend/css/style.css">
