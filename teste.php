<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dias'])) {
        
        $diasSelecionados = implode(", ", $_POST['dias']);
      
        print_r($_POST['dias']);
        
    } else {
        echo "Nenhum dia foi selecionado.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="teste.php" method="POST">
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
        <button type="submit" name="save" class="btn btn-success">Salvar</button>
    </form>
</body>
</html>