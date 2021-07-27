<?php
session_start();

if (!isset($_SESSION['is_admin'])) {
  header('Location: http://localhost:8888/biblioteca/login.php');
}elseif ($_SESSION['is_admin'] == 0){
  header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
} 

include __DIR__ . '/includes/Users.php';

include __DIR__ . '/includes/Books.php';

include __DIR__ .'/includes/header.php';

include __DIR__ . '/includes/utils.php';



if (isset($_GET['stato'])) {
  \Biblos\Utils\show_alert('inserimento', $_GET['stato']);
  }

$users= \Biblos\Users::showUsers();


//se con 1 non va prova true
$books= \Biblos\Book::showStatus(1);  




?>

<h2>Libri in uscita</h2>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="./includes/insert-rent.php">
              <div class="mb-3">

                <label class="form-label fw-bold my-2">Titolo libro</label>
                <select name="title" class="form-select" id="title" required>
                    <?php foreach($books as $book):?>
                    <option id="title" value="<?php echo $book['title'] ?>"> <?php echo $book['title'] ?> </option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold my-2">Email Utente</label>
                <select name="email" class="form-select" id="email" required>
                    <?php foreach($users as $user):?>
                    <option id="email" value="<?php echo $user['email'] ?>"> <?php echo $user['email'] ?> </option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3 form-check">
                <label for="date-end" class="form-label">Data fine prestito</label>
                <input name="rent_end" type="date" class="form-control" id="date-end" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include __DIR__ . '/includes/footer.php'; ?>


