<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: http://localhost:8888/biblioteca/login.php?stato=errore&messages=Esegui login');
  } 

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/Books.php';

include __DIR__ . '/includes/utils.php';

if(isset($_GET['stato'])){
    \Biblos\Utils\show_alert('inserimento',$_GET['stato']);
}

if(isset($_GET['available'])){
    $books= \Biblos\Book::showStatus($_GET['available']);
}else{
    
    $books = \Biblos\Book::selectBook();
}

  
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Tutti i libri</h2>
        </div>
    </div>
</div>



<section class="container">
    <div class="row" id="ava">
        <div class="col-12 col-md-6 text-center">
                <h2>Cerca libro per titolo</h2>
                <form class="d-flex" method="POST" action="./search-title.php">
                    <input name="q" class="form-control me-2" type="search" placeholder="Cerca titolo" aria-label="Cerca">
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
        </div>
        <div class="col-12 col-md-6 text-end">
            <a href="./all-books.php#ava" class="btn btn-outline-dark">Tutti i libri</a>
            <a href="./all-books.php?available=true#ava" class="btn btn-outline-success">Disponibile🟢</a>
            <a href="./all-books.php?available=false#ava" class="btn btn-outline-danger">In prestito 🔴</a>
        </div>
    </div>
</section>

<div class="container my-5">
    <div class="row">
        <?php foreach($books as $book): ?>
        <div class="col-12 col-md-4">
                <div class="card">
                  <?php if($book['cover']): ?>
                    <img src="./images/<?php echo $book['cover'] ?>" class="card-img-top img-fluid" alt="...">
                  <?php else :?>
                    <img src="./images/libro.jpg" class="card-img-top img-fluid" alt="...">
                  <?php endif?>
                    <div class="card-body">
                        <h5 class="card-title">Titolo: <?php echo $book['title'] ?></h5>
                        <p class="card-text">Autore: <?php echo $book['author_name'] ?> </p>
                        <p class="card-text">Anno Pubb: <?php echo $book['published_year'] ?> </p>
                        <p class="card-text">€<?php echo $book['price'] ?> </p>
                        <p class="card-text">ISBN: <?php echo $book['ISBN'] ?> </p>
                        <p class="card-text"><small class="text-muted">Disponibile : <?php $book['available']== 0 ? printf('🔴'):printf('🟢') ?></small></p>
                        <a href="detail-book.php?id=<?php echo $book['id'];?>" class="btn btn-outline-dark">Dettaglio</a>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



