<?php
// session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Biblioteca</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">Biblos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <?php if ( isset( $_SESSION['email'] ) && $_SESSION['is_admin'] == 1): ?>
        <li class="nav-item">
            <a class="nav-link" href="./all-books.php">Libri</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./book-insert.php">Inserisci libro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./register-user.php">Inserisci Utente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./all-users.php">Utenti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./rent-insert.php">Inserisci Prestito</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./all-rents.php">Prestiti</a>
        </li>
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Ciao <?php echo $_SESSION['name']; ?></a>
            </li>
            <li class="nav-item">
                  <a class="nav-link" href="/biblioteca/includes/login.php?logout=1">Logout</a>
            </li>
        <?php elseif ( isset( $_SESSION['email'] ) && $_SESSION['is_admin'] == 0): ?>
          <li class="nav-item">
            <a class="nav-link" href="./all-books.php">Libri</a>
          </li>
          <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Ciao <?php echo $_SESSION['name']; ?></a>
            </li>
            <li class="nav-item">
                  <a class="nav-link" href="/biblioteca/includes/login.php?logout=1">Logout</a>
            </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>

      <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>