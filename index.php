<?php
require_once "Backend/config/Database.php";
require_once "./Frontend/template/header.php";
?>

<main>
  <section class="cards">
    <div class="card acoes">
      <h2>Ações Rápidas</h2>
      <div class="acoes-item">
        <a href="cadastrar_evento.php">Cadastrar Evento</a>
      </div>
      <div class="acoes-item">
        <a href="cadastrar_tipo.php">Cadastrar Tipo de Evento</a>
      </div>
      <div class="acoes-item">
        <a href="cadastrar_sala.php">Cadastrar Sala</a>
      </div>
      <div class="acoes-item">
        <a href="fazer_reserva.php">Fazer Reserva</a>
      </div>
    </div>

    <div class="card consultas">
      <h2>Consultas</h2>
      <div class="consultas-item">
        <a href="consultar_eventos.php">Consultar Eventos</a>
      </div>
      <div class="consultas-item">
        <a href="consultar_tipos.php">Consultar Tipos de Evento</a>
      </div>
      <div class="consultas-item">
        <a href="consultar_salas.php">Consultar Salas</a>
      </div>
      <div class="consultas-item">
        <a href="consultar_reservas.php">Consultar Reservas</a>
      </div>
    </div>
  </section>
</main>

<?php
require_once "./Frontend/template/footer.php";
?>
