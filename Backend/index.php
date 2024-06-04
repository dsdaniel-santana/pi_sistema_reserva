<?php
require_once "config/Database.php";
require_once "dao/ReservaDAO.php";

$reservaDAO = new ReservaDAO();
$reserva = new Reserva(null, "Reservado", "2024-03-10", "2024-05-20", "08:00:56", "12:30:34", "2-3-4-6", 1, 1 );
echo $reservaDAO->delete(2);

?>

<link rel="stylesheet" href="../pi_sistema_reserva/Frontend/css/style.css">
