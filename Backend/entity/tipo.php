<?php

class Tipo {
    private $id;
    private $tipo;

    public function __construct($id, $tipo)
    {
        $this->id = $id;
        $this->tipo = $tipo;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    //SETTERS
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            </div>
        </div>
    </nav>


    <div class="container">
        <h1 class="my-4">Detalhes do Contato</h1>
        <form action="detalhes.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $contato ? $contato->getId() : ''  ?>">
            <div class="card">
                <div class="card-body">
                    
                   
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $contato ? $contato->getEmail() : ''  ?>" required>
                    </div>
                    <button type="submit" name="save" class="btn btn-success">Salvar</button>
                    <?php if($contato): ?>
                        <button type="submit" name="delete" class="btn btn-danger">Excluir</button>
                    <?php endif ?>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </form>
    </div>



</body>

</html>