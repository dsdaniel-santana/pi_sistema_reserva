
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Reserva de Salas</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
      min-height: 100vh;
      margin-bottom: 200px;
      font-family: 'Poppins', sans-serif;
      background-color: aliceblue;
    }

    :root {
      font-size: 90%;
    }


    nav {
      min-height: 70px;
      box-shadow: 0px 2px 5px 2px rgba(0, 0, 0, .2);
      background-color: #fff;
    }

 

    .form-select {
      width: 100%;
    }

    #btnLogout {
      background-color: #fff;
      border: none;
      font-size: 1.2rem;
      margin-top: 7px;
    }

    .card {
      margin-bottom: 1rem;
      background-color: #fff;
    }

    .navbar-nav a {
      width: 100%;
      color: black;
      font-size: 1.2rem;
      transition: .3s ease;
    }

    .navbar-nav a:hover {
      color: #6F6F6F;
    }

    .fa-bars {
      margin-top: 5px;
    }


    footer {
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
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="logo-senac.webp" alt="Logo Senac" width="90" height="40">
          </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="mapao.php">Mapa</a>
            <a class="nav-link" href="eventos.php">Eventos</a>
            <a class="nav-link" href="sala.php">Salas</a>
            <a class="nav-link" href="tipo.php">Labs</a>
            <?php if (isset($_SESSION['token'])) : ?>
            <a class="nav-link" href="login.php">Adicionar </a>

              <li class="nav-item">
                <form action="authService.php" method="post" style="display: inline;">
                  <input type="hidden" name="type" value="logout">
                  <button id="btnLogout" type="submit">Logout</button>
                </form>
              </li>
            <?php else : ?>
              <a class="nav-link" href="login.php"><b>Login</b></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>