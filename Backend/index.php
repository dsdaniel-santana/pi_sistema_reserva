<?php
require_once "config/Database.php";
require_once "dao/EventoDAO.php";
require_once "entity/Evento.php";
require_once "dao/SalaDAO.php";

$salaDAO = new SalaDAO();
$sala = new Sala(2, "13", 40, 1, 2);
echo $salaDAO->delete(3);

?>

<link rel="stylesheet" href="../pi_sistema_reserva/Frontend/css/style.css">