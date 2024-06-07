<?php
require_once "config/Database.php";
require_once "dao/ReservaDAO.php";


$reservaDAO = new ReservaDAO();

$reservas = $reservaDAO->getAll();

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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="my-4">Lista de Reservas</h1>
        <a href="detalhes.php" class="btn btn-primary mb-4">Adicionar Contato</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($reservas as $reserva) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($reserva->getStatus_sala(), ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($reserva->getData_inicio(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($reserva->getHoraio_fim(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>