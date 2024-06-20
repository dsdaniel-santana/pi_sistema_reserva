<?php
require_once "Backend/config/Database.php";
require_once "Backend/dao/salaDAO.php";

$salaDAO = new salaDAO();
$salas = $salaDAO->getAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

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
        <h1 class="my-4">Lista de Salas</h1>
        <a href="add_sala.php" class="btn btn-primary mb-4">Adicionar Sala</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($salas as $sala) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">ID da Sala <?php echo htmlspecialchars($sala->getId(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text">Numero de Sala: <?php echo htmlspecialchars($sala->getNumero(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text">Capacidade <?php echo htmlspecialchars($sala->getCapacidade(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text">Andar <?php echo htmlspecialchars($sala->getAndar(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text">ID de Tipo de Sala <?php echo htmlspecialchars($sala->getTipo_id(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="add_sala.php?id=<?php echo $sala->getId(); ?>" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>    
        </div>
    </div>
</body>
</html>