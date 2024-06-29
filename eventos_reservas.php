<?php

session_start(); // Inicia uma sessão na página

if(!isset($_SESSION['token'])) {
    header("Location: ./login.php");
    exit();
}

include_once "../pi_sistema_reserva/Backend/config/Database.php";
include_once "../pi_sistema_reserva/Backend/dao/EventoDAO.php";
include_once "../pi_sistema_reserva/Backend/entity/Evento.php";

require_once "Backend/config/Database.php";
require_once "Backend/dao/ReservaDAO.php";
require_once "Backend/dao/SalaDAO.php";

$reservaDAO = new ReservaDAO();
$reservas = $reservaDAO->getAll();

$salaDAO = new SalaDAO();
$salas = $salaDAO->getAll();

$reservaEventoById = $reservaDAO->getbyEvento_id($_GET['evento_id']);
//print_r($reservaEventoById);



$eventoDAO = new EventoDAO();
$evento = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['evento_id'])) {
    $evento  = $eventoDAO->getById($_GET['evento_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $evento  = $eventoDAO->getById($_POST['id']);
            // $dias_semanaStr = implode(", ", $_POST['dias']);

            $evento->setTitulo($_POST['titulo']);
            $evento->setSigla($_POST['sigla']);
            $evento->setDocente($_POST['docente']);
            $evento->setOferta($_POST['oferta']);


            $eventoDAO->update($evento);
        } else {
            $novoEvento = new Evento(null, $_POST['titulo'],$_POST['sigla'], $_POST['docente'], $_POST['oferta']);
            $eventoDAO->create($novoEvento);
        }

        $evento = $eventoDAO->getByOferta($_POST['oferta']);
        if($evento) {
            header("Location: add_reserva.php?evento_id=" . $evento->getId() . "&reserva_id=" . $_POST['reserva_id'] );
             exit();
        }
        
    }


    if (isset($_POST['delete']) && $evento->getId()) {
        $eventoDAO->delete($evento->getId());
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
        <h3 class="my-4">Detalhes do Evento</h3>
        <h3 class="my-4">Detalhes do Evento</h3>
        <form action="eventos_add.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $evento ? $evento->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="titulo">Titulo do Evento:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $evento ? $evento->getTitulo() : ''  ?>" required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="reserva_id">Titulo do Evento:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="reserva_id" name="reserva_id" value="<?php echo $_GET['reserva_id'] ? $_GET['reserva_id'] : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="sigla">Sigla do Evento:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="sigla" name="sigla" value="<?php echo $evento ? $evento->getSigla() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="docente">Docente:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="docente" name="docente" value="<?php echo $evento ? $evento->getDocente() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="oferta">Oferta:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="oferta" name="oferta" value="<?php echo $evento ? $evento->getOferta() : ''  ?>" required>
                    </div>


                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <a href="eventos.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>

        <h1>reservas</h1>

        <?php if(!$reservaEventoById) {
            echo "<h3>Este evento não contem reservas cadastradas</h3>";
            echo "<a href='add_reserva.php?evento_id=" . $_GET['evento_id'] . "'class='btn btn-primary'>Detalhes</a>";
        }?>
            <?php foreach ($reservaEventoById as $reserva) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                           
                            <p class="card-text"><b>Data Inicio:</b> <?php echo htmlspecialchars($reserva ? $reserva->getData_inicio() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Data Fim:</b> <?php echo htmlspecialchars($reserva ? $reserva->getData_fim() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Horario Inicio:</b> <?php echo htmlspecialchars($reserva ? $reserva->getHorario_inicio() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Horario Fim:</b> <?php echo htmlspecialchars($reserva ? $reserva->getHoraio_fim() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Dias da Semana:</b> <?php echo htmlspecialchars($reserva ? $reserva->getDias_semana() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="add_reserva.php?evento_id=<?php echo $_GET['evento_id']; ?>&reserva_id=<?php echo $reserva->getId(); ?>" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
</body>




</html>