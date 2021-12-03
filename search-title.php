<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/biblioteca/login.php?stato=errore&messages=Esegui il login per effettuare ricerche');
  } 
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/Books.php';

$q =\Biblos\Book::search($_POST);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2> Ecco i risultati per la tua ricerca</h2>
        </div>
        <div class="col-12 col-md-4">
                <div class="card">
                  <?php if($q['cover']): ?>
                    <img src="./images/<?php echo $q['cover'] ?>" class="card-img-top img-fluid" alt="...">
                  <?php else :?>
                    <img src="./images/libro.jpg" class="card-img-top img-fluid" alt="...">
                  <?php endif?>
                    <div class="card-body">
                        <h5 class="card-title">Titolo: <?php echo $q['title'] ?></h5>
                        <p class="card-text">Autore: <?php echo $q['author_name'] ?> </p>
                        <p class="card-text">Anno Pubb: <?php echo $q['published_year'] ?> </p>
                        <p class="card-text">€<?php echo $q['price'] ?> </p>
                        <p class="card-text"><small class="text-muted">Disponibile : <?php $q['available']== 0 ? printf('🔴'):printf('🟢') ?></small></p>
                        <a href="./detail-book.php?id=<?php echo $q['id'];?>" class="btn btn-outline-dark">Dettaglio</a>
                    </div>
                </div>
        </div>
        
    </div>
</div>


<?php include __DIR__ . '/includes/footer.php'; ?>

