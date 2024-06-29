<?php
require_once "Backend/config/Database.php";
require_once "Backend/dao/ReservaDAO.php";
require_once "Backend/dao/SalaDAO.php";


$reservaDAO = new ReservaDAO();
$reservas = $reservaDAO->getAll();

$salaDAO = new SalaDAO();
$salas = $salaDAO->getAll();

?>

<?php
    require_once "Frontend/template/header.php";
?>

    <div class="container">
        <h1 class="my-4">Lista de Reservas</h1>
        <a href="eventos_add.php" class="btn btn-primary mb-4">Adicionar Contato</a>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($reservas as $reserva) : ?>
                <?php
                   require_once "Backend/dao/EventoDAO.php";
                   require_once "Backend/entity/Evento.php";
                   $eventoDAO = new EventoDAO();
                   $evento = $eventoDAO->getById($reserva->getEvento_id());
                ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <!-- Inserindo em telas os dados do Evento  -->
                            <h5 class="card-title"><b>Titulo:</b> <?php echo $evento? $evento->getTitulo() : ''; ?></h5>
                            <p class="card-text"><b>Oferta:</b> <?php echo $evento? $evento->getOferta() : ''; ?></p>
                            <hr>

                            <p class="card-text"><b>Data Inicio:</b> <?php echo htmlspecialchars($reserva ? $reserva->getData_inicio() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Data Fim:</b> <?php echo htmlspecialchars($reserva ? $reserva->getData_fim() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Horario Inicio:</b> <?php echo htmlspecialchars($reserva ? $reserva->getHorario_inicio() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Horario Fim:</b> <?php echo htmlspecialchars($reserva ? $reserva->getHoraio_fim() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><b>Dias da Semana:</b> <?php echo htmlspecialchars($reserva ? $reserva->getDias_semana() : '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <a href="eventos_add.php?reserva_id=<?php echo $reserva->getId(); ?>&evento_id=<?php echo $reserva->getEvento_id(); ?>" class="btn btn-primary">Detalhes</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

<?php
    require_once "Frontend/template/footer.php";
?>

</html>