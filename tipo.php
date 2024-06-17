<?php
require_once "Backend/config/Database.php";
require_once "Backend/dao/tipoDAO.php";

$tipoDAO = new TipoDAO();
$tipos = $tipoDAO->getAll();
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
        <h1 class="my-4">Lista de Tipos de Salas</h1>
        <a href="add_tipo.php" class="btn btn-primary mb-4">Adicionar Tipo de Sala</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($tipos as $tipo) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">ID da Sala <?php echo htmlspecialchars($tipo->getId(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text">Tipo de Sala: <?php echo htmlspecialchars($tipo->getTipo(), ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="add_tipo.php?id=<?php echo $tipo->getId(); ?>" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>    
        </div>
    </div>
</body>
</html>