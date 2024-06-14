<?php

//session_start(); // Inicia uma sessão na página

// if(!isset($_SESSION['token'])) {
//     header('Location: auth.php');
//     exit();
// }

include_once "../pi_sistema_reserva/Backend/config/Database.php";
include_once "../pi_sistema_reserva/Backend/dao/EventoDAO.php";
include_once "../pi_sistema_reserva/Backend/entity/Evento.php";

// require_once 'Backend/dao/EventoDAO.php';
//require_once '../pi_sistema_reserva/Backend/config/Database.php';
//require_once 'Backend/dao/EventoDAO.php';
//require_once 'Backend/entity/';

$eventoDAO = new EventoDAO();
$evento = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $evento  = $eventoDAO->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $evento  = $eventoDAO->getById($_POST['id']);
            // $dias_semanaStr = implode(", ", $_POST['dias']);

            $evento->setTitulo($_POST['titulo']);
            $evento->setDocente($_POST['docente']);
            $evento->setOferta($_POST['oferta']);

            
            $eventoDAO->update($evento);
        } else {
            $novoEvento = new Evento(null, $_POST['evento'], $_POST['docente'], $_POST['oferta']);
            $eventoDAO->create($novoEvento);
        }

        header('Location: eventos.php');
        exit;
    }

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $eventoDAO->delete($_POST['id']);
        header('Location: eventos.php');
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
        <form action="eventos_add.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $evento ? $evento->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo">Titulo do Evento:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $evento ? $evento->getTitulo() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="docente">Docente:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $evento ? $evento->getDocente() : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="oferta">Oferta:</label>
                        <!-- <label for="status_sala">status:</label> -->
                        <input type="text" class="form-control" id="oferta" name="oferta" value="<?php echo $evento ? $evento->getOferta() : ''  ?>" required>
                    </div>


                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if ($evento) : ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>
                    <a href="eventos.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>