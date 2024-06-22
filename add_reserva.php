<?php
require_once 'Backend/dao/ReservaDAO.php';
require_once 'Backend/entity/Reserva.php';
require_once "Backend/dao/EventoDAO.php";

$reservaDAO = new ReservaDAO();
$reserva = null;

$eventoDAO = new EventoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserva_id'])) {
    $reserva  = $reservaDAO->getById($_POST['reserva_id']);
    $evento  = $eventoDAO->getById($_GET['evento_id']);
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
            $dias_semanaStr = implode(", ", $_POST['dias']);
            $novaReserva = new Reserva(null, $_POST['status_sala'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['horario_inicio'], $_POST['horario_fim'], $dias_semanaStr, $_POST['evento_id'], $_POST['sala_id']);
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
    <title>Detalhes da Reserva</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">
        
        <h3>Detalhes da Reserva</h3>
        <br>
        <form action="add_reserva.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $reserva ? $reserva->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    <div class="form-group" style="display: none;">
                        <label for="evento_id">Evento id:</label>
                        <input type="number" class="form-control" id="evento_id" name="evento_id" value="<?php echo $_GET['evento_id'] ? $_GET['evento_id'] : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status_sala">status:</label>
                        <input type="text" class="form-control" id="status_sala" name="status_sala" value="<?php echo $reserva ? $reserva->getStatus_sala() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="data_inicio">Data Inicio:</label>
                        <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $reserva ? $reserva->getData_inicio() : ''  ?>">
                    </div>
                    <div class="form-group">
                        <label for="data_fim">Data Fim:</label>
                        <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_inicio">horario Inicio:</label>
                        <input type="time" class="form-control" id="horario_inicio" name="horario_inicio" value="<?php echo $reserva ? $reserva->getHorario_inicio() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_fim">Horario Fim:</label>
                        <input type="time" class="form-control" id="horario_fim" name="horario_fim" value="<?php echo $reserva ? $reserva->getHoraio_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <h5>Dias Da Semana:</h5>
                        <div style="display: flex;">
                            <label for="seg">Seg:</label>
                            <input type="checkbox" class="form-control" id="seg" name="dias[]" value="1">
                            <label for="ter">Ter:</label>
                            <input type="checkbox" class="form-control" id="ter" name="dias[]" value="2">
                            <label for="qua">Qua:</label>
                            <input type="checkbox" class="form-control" id="qua" name="dias[]" value="3">
                            <label for="qui">Qui:</label>
                            <input type="checkbox" class="form-control" id="qui" name="dias[]" value="4">
                            <label for="sex">Sex:</label>
                            <input type="checkbox" class="form-control" id="sex" name="dias[]" value="5">
                            <label for="sab">Sab:</label>
                            <input type="checkbox" class="form-control" id="sab" name="dias[]" value="6">
                            <label for="dom">Dom:</label>
                            <input type="checkbox" class="form-control" id="dom" name="dias[]" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sala_id">Sala id:</label>
                        <input type="number" class="form-control" id="sala_id" name="sala_id" value="<?php echo $reserva ? $reserva->getSala_id() : ''  ?>" required>
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