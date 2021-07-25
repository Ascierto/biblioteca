<?php
session_start();

if (!isset($_SESSION['is_admin'])) {
    header('Location: http://localhost:8888/biblioteca/login.php');
  }elseif ($_SESSION['is_admin'] == 0){
    header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
  }
  
    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/includes/utils.php';

    if (isset($_GET['stato'])) {
        \Biblos\Utils\show_alert('inserimento', $_GET['stato']);
    }
  
?>



        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 card p-5">
                    <form method="POST" action="./includes/register.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input name="name" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Cognome</label>
                            <input name="surname" type="text" class="form-control" id="surname" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleEmail1" class="form-label">Indirizzo email</label>
                            <input name="email" type="email" class="form-control" id="exampleEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="pass-check" class="form-label">Ripeti password</label>
                            <input name="password-check" type="password" class="form-control" id="pass-check">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>


        <?php include __DIR__ . '/includes/footer.php'; ?>