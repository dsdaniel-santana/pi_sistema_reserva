<?php

//session_start(); // Inicia uma sessão na página

// if(!isset($_SESSION['token'])) {
//     header('Location: auth.php');
//     exit();
// }

require_once "Backend/config/Database.php";
require_once "Backend/dao/tipoDAO.php";


if (!isset($tipo)) {
    $tipo = null;
}

$tipoDAO = new TipoDAO();
$tipos = null;


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $tipo = $tipoDAO->getById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save'])) {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $tipo = $tipoDAO->getById($_POST['id']);

            $tipo->setTipo_sala($_POST['tipo_sala']);


            $tipoDAO->update($tipo);
        } else {
            $novoTipo = new Tipo(null, $_POST['tipo_sala']);
            $tipoDAO->create($novoTipo);
        }

        header('Location: tipo.php');
        exit;
    }

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $tipoDAO->delete($_POST['id']);
        header('Location: tipo.php');
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
        <h1 class="my-4">Detalhes do Tipo de Sala</h1>
        <form action="add_tipo.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $tipo ? $tipo->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="tipo_sala">Tipo de Sala</label>
                        <input type="text" class="form-control" id="tipo_sala" name="tipo_sala" value="<?php echo $tipo ? $tipo->getTipo() : ''  ?>" required>
                    </div>

                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if ($tipo) : ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>
                    <a href="tipo.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>