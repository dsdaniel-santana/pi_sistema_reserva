<?php

session_start(); // Inicia uma sessão na página

if(!isset($_SESSION['token'])) {
    header("Location: ./login.php");
    exit();
}

require_once "Backend/config/Database.php";
require_once "Backend/dao/salaDAO.php";


if (!isset($sala)) {
    $sala = null;
}

$salaDAO = new salaDAO();
$salas = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $sala = $salaDAO->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $sala = $salaDAO->getById($_POST['id']);


            $sala->setNumero($_POST['numero']);
            $sala->setCapacidade($_POST['capacidade']);
            $sala->setAndar($_POST['andar']);
            $sala->setTipo_id($_POST['tipo_id']);


            $salaDAO->update($sala);
        } else {
            $novaSala = new Sala(null, $_POST['numero'], $_POST['capacidade'], $_POST['andar'], $_POST['tipo_id']);
            $salaDAO->create($novaSala);
        }

        header('Location: sala.php');
        exit;
    }

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $salaDAO->delete($_POST['id']);
        header('Location: sala.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Reserva</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">
        <h1 class="my-4">Detalhes da Sala</h1>
        <form action="add_sala.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $sala ? $sala->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="numero">Número da Sala</label>
                        <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $sala ? $sala->getNumero() : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="capacidade">Capacidade da Sala</label>
                        <input type="text" class="form-control" id="capacidade" name="capacidade" value="<?php echo $sala ? $sala->getCapacidade() : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="andar">Andar Sala</label>
                        <input type="text" class="form-control" id="andar" name="andar" value="<?php echo $sala ? $sala->getAndar() : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_id">Tipo ID de Sala</label>
                        <input type="text" class="form-control" id="tipo_id" name="tipo_id" value="<?php echo $sala ? $sala->getTipo_id() : '' ?>" required>
                    </div>


                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if ($sala) : ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>
                    <a href="sala.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>