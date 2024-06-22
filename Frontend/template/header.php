<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Reserva de Salas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    nav {
      min-height: 70px;

    }

    .navbar-nav a{
        color: black;
        transition: .3s ease;
    }

    .navbar-nav a:hover {
      color: #6F6F6F;
    }

    .fa-bars {
      margin-top: 5px;
    }
    footer {
      background-color: #ddd;
      color: #333;
      padding: 10px;
      text-align: center;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      /* z-index: 1000; */
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="mapao.php"><b>Mapa</b></a>
            <a class="nav-link" href="index.php"><b>Reserva</b></a>
            <a class="nav-link" href="sala.php"><b>Salas</b></a>
            <a class="nav-link" href="tipo.php"><b>Labs</b></a>
            <a class="nav-link" href="login.php"><b>Login</b></a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>