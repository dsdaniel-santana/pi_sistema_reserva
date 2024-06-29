<?php
require_once "Backend/config/Database.php";
require_once "Backend/dao/ReservaDAO.php";
require_once "Backend/dao/tipoDAO.php";
require_once "Backend/dao/EventoDAO.php";
require_once "Backend/dao/SalaDAO.php";

$mapaoDAO = new ReservaDAO();
$mapao = $mapaoDAO->listarSalas(date("y-m-d"), date("H:m:s"), date("H:m:s"));

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['save']) {
        $data = $_POST['data'];
        $horario_inicio = $_POST['horario_inicio'];
        $horario_fim = $_POST['horario_fim'];

        $mapao = $mapaoDAO->listarSalas($data, $horario_inicio, $horario_fim);
    } else {
        //$mapao = $mapaoDAO->listarSalas("2024-06-27", "20:00:00", "22:00:00");
    }
}

?>
<?php
require_once "Frontend/template/header.php";
?>

<body>
    <div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Filtrar
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="mapao.php" method="post">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="data_inicio">Data: </label>
                                    <input type="date" class="form-control" name="data" require>
                                </div>

                                <div class="form-group">
                                    <label for="data_inicio">Horario Inicio: </label>
                                    <input type="time" class="form-control" name="horario_inicio" require>

                                </div>
                                <label for="data_inicio">Horario Fim: </label>
                                <input type="time" class="form-control" name="horario_fim" require>
                                <br>
                                <button type="submit" name="save" class="btn btn-success">Filtar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <h1>Mapa de salas</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Sala</th>
                <th scope="col">Titulo</th>
                <th scope="col">Inicio</th>
                <th scope="col">Fim</th>
                <th scope="col">Docente</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($mapao as $mapa) : ?>
                <tr>
                    <th scope="row"><?php echo $mapa['numero'] ?></th>
                    <td><?php echo $mapa['titulo'] ?></td>
                    <td><?php echo $mapa['horario_inicio'] ?></td>
                    <td><?php echo $mapa['horario_fim'] ?></td>
                    <td><?php echo $mapa['docente'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </div>
   
    <?php
    require_once "Frontend/template/footer.php";
    ?>

    </html>