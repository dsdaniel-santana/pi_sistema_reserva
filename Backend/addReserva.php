<?php

//session_start(); // Inicia uma sessão na página

// if(!isset($_SESSION['token'])) {
//     header('Location: auth.php');
//     exit();
// }

require_once 'dao/ReservaDAO.php';

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
                        <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_inicio">horario Inicio:</label>
                        <input type="time" class="form-control" id="horario_inicio" name="horario_inicio" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_fim">Horario Fim:</label>
                        <input type="time" class="form-control" id="horario_fim" name="horario_fim" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <h5>Dias Da Semana:</h5>
                        <div style="display: flex;">
                        <label for="seg">Seg:</label>
                        <input type="checkbox" class="form-control" id="seg" name="seg">
                        <label for="ter">Ter:</label>
                        <input type="checkbox" class="form-control" id="ter" name="ter">
                        <label for="qua">Qua:</label>
                        <input type="checkbox" class="form-control" id="qua" name="qua">
                        <label for="qui">Qui:</label>
                        <input type="checkbox" class="form-control" id="qui" name="qui">
                        <label for="sex">sex:</label>
                        <input type="checkbox" class="form-control" id="sex" name="sex">
                        <label for="sab">Sab:</label>
                        <input type="checkbox" class="form-control" id="sab" name="sab">
                        <label for="dom">Dom:</label>
                        <input type="checkbox" class="form-control" id="dom" name="dom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="evento_id">Evento id:</label>
                        <input type="number" class="form-control" id="evento_id" name="evento_id" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sala_id">Sala id:</label>
                        <input type="number" class="form-control" id="sala_id" name="sala_id" value="<?php echo $reserva ? $reserva->getData_fim() : ''  ?>" required>
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