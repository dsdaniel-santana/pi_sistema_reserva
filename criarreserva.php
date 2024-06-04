<?php
require_once "Backend/config/Database.php";
require_once "./Frontend/template/header.php";
?>

<link rel="stylesheet" href="/css/style.css">

<main>
<h1>Nova Reserva</h1>
    <form action="processa_reserva.php" method="post">
        <label for="status_sala">Status da Sala:</label>
        <select name="status_sala" id="status_sala">
            <option value="Livre">Livre</option>
            <option value="Reservado">Reservado</option>
            <option value="Em Manutenção">Em Manutenção</option>
        </select><br>
        <label for="data_inicio">Data de Início:</label>
        <input type="date" name="data_inicio" id="data_inicio" required><br>
        <label for="data_fim">Data de Fim:</label>
        <input type="date" name="data_fim" id="data_fim" required><br>
        <label for="horario_inicio">Horário de Início:</label>
        <input type="time" name="horario_inicio" id="horario_inicio" required><br>
        <label for="horario_fim">Horário de Fim:</label>
        <input type="time" name="horario_fim" id="horario_fim" required><br>
        <label for="dias_semana">Dias da Semana (siglas separadas por vírgulas):</label>
        <input type="text" name="dias_semana" id="dias_semana" required><br>
        <label for="evento_ID">Evento:</label>
        <select name="evento_ID" id="evento_ID">
            </select><br>
        <label for="sala_ID">Sala:</label>
        <select name="sala_ID" id="sala_ID">
            </select><br>
        <button type="submit">Reservar</button>
    </form>
</main>

<?php
require_once "./Frontend/template/footer.php";
?>
