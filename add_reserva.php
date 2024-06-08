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

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $reserva  = $reservaDAO->getById($_GET['id']);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {    
    if(isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $reserva  = $reservaDAO->getById($_POST['id']);

            //$reserva->setStatus_sala($_POST['status_sala']);
            

            $reservaDAO->update($reserva);
        } else {
            $novaReserva = new Reserva(null, $_POST['status_sala'], $_POST['data_inicio'], $_POST['data_fim'], $_POST['horario_inicio'], $_POST['horario_fim'], $_POST['dias_semana'], 1, 1);
            $reservaDAO->create($novaReserva);            
        }

        header('Location: index.php');
        exit;
    }

    if(isset($_POST['delete']) && isset($_POST['id'])) {
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
    <title>Detalhes do Contato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="container">
        <h1 class="my-4">Detalhes do Contato</h1>
        <form action="detalhes.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $reserva ? $reserva->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
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
                        <input type="datetime" class="form-control" id="data_fim" name="data_fim" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
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
                        <label for="2">Seg:</label>
                        <input type="checkbox" class="form-control" id="2" name="2">
                        <label for="3">Ter:</label>
                        <input type="checkbox" class="form-control" id="3" name="3">
                        <label for="4">Qua:</label>
                        <input type="checkbox" class="form-control" id="4" name="4">
                        <label for="5">Qui:</label>
                        <input type="checkbox" class="form-control" id="5" name="5">
                        <label for="6">Sex:</label>
                        <input type="checkbox" class="form-control" id="6" name="6">
                        <label for="7">Sab:</label>
                        <input type="checkbox" class="form-control" id="7" name="7">
                        <label for="1">Dom:</label>
                        <input type="checkbox" class="form-control" id="1" name="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="evento_id">Evento id:</label>
                        <input type="number" class="form-control" id="evento_id" name="evento_id" value="<?php echo $reserva ? $reserva->getEvento_id() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sala_id">Sala id:</label>
                        <input type="number" class="form-control" id="sala_id" name="sala_id" value="<?php echo $reserva ? $reserva->getSala_id() : ''  ?>" required>
                    </div>
                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if($reserva) : ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>    
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>