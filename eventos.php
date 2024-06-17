<?php
include_once "Backend/config/Database.php";
include_once "Backend/dao/EventoDAO.php";
include_once "Backend/entity/Evento.php";

$eventoDAO = new EventoDAO();
$eventos = $eventoDAO->getAll();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
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
        <h1 class="my-4">Lista de Eventos</h1>
        <a href="eventos_add.php" class="btn btn-primary mb-4">Adicionar Eventos</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">        
            <?php foreach ($eventos as $evento) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Titulo: <?php echo $evento->getTitulo(); ?></h5>
                            <p class="card-text">Docente: <?php echo $evento->getDocente(); ?></p>
                            <p class="card-text">Oferta: <?php echo $evento->getOferta(); ?></p>                            
                            <a href="eventos_add.php?id=<?php echo $evento->getId(); ?>" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>
