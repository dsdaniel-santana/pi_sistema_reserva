<?php
require_once "Backend/config/Database.php";
require_once "Backend/dao/ReservaDAO.php";
require_once "Backend/dao/tipoDAO.php";
require_once "Backend/dao/EventoDAO.php";
require_once "Backend/dao/SalaDAO.php";

$salaDAO = new SalaDAO();
$salas = $salaDAO->getAll();

$eventoDAO = new EventoDAO();
$evento = $eventoDAO->getById(1);

$reservaDAO = new ReservaDAO();
$reserva = $reservaDAO->getById(2);

$mapao = $reservaDAO->listarSalas(1);

print_r($mapao)


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Mapa de salas</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Sala</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fim</th>
                    <th scope="col">Docente</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($salas as $sala) : ?>
                <tr>
                    <?php $mapao =  $reservaDAO->listarSalas($sala->getId());?>
                    <th scope="row"><?php echo $sala->getNumero()?></th>
                    <td><?php echo $evento->getTitulo() ?></td>
                    <td><?php echo $reserva->getHorario_inicio() ?></td>
                    <td><?php echo $reserva->getHoraio_fim() ?></td>
                    <td><?php echo $evento->getDocente() ?></td>
                </tr>
                <?php endforeach; ?>   
            </tbody>
        </table>
    </div>

</body>

</html>