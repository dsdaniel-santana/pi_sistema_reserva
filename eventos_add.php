<?php

//session_start(); // Inicia uma sessão na página

// if(!isset($_SESSION['token'])) {
//     header('Location: auth.php');
//     exit();
// }

require_once 'Backend/dao/ReservaDAO.php';
require_once 'Backend/entity/Reserva.php';

$reservaDAO = new ReservaDAO();
$reserva = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reserva  = $reservaDAO->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $reserva  = $reservaDAO->getById($_POST['id']);
            $dias_semanaStr = implode(", ", $_POST['dias']);

            $reserva->setStatus_sala($_POST['status_sala']);
            $reserva->setData_inicio($_POST['data_inicio']);
            $reserva->setData_fim($_POST['data_fim']);
            $reserva->setHorario_inicio($_POST['horario_inicio']);
            $reserva->setHoraio_fim($_POST['horario_fim']);
            $reserva->setDias_semana($dias_semanaStr);
            $reserva->setEvento_id($_POST['evento_id']);
            $reserva->setSala_id($_POST['sala_id']);

            $reservaDAO->update($reserva);
        } else {
            $novaReserva = new Reserva(null, $_POST['status_sala'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['horario_inicio'], $_POST['horario_fim'], $_POST['dias_semana'], 1, 1);
            $reservaDAO->create($novaReserva);
        }

        header('Location: index.php');
        exit;
    }

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $reservaDAO->delete($_POST['id']);
        header('Location: index.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">
        <h1 class="my-4">Detalhes do Evento</h1>
        <form action="add_reserva.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $reserva ? $reserva->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="status_sala">Titulo do Evento:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="status_sala" name="status_sala" value="<?php echo $reserva ? $reserva->getStatus_sala() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="status_sala">Docente:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="status_sala" name="status_sala" value="<?php echo $reserva ? $reserva->getStatus_sala() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="status_sala">Oferta:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="status_sala" name="status_sala" value="<?php echo $reserva ? $reserva->getStatus_sala() : ''  ?>" required>
                    </div>



                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if ($reserva) : ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>