<?php

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/Books.php';

$books = \Biblos\Book::selectBook();
  
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Tutti i libri</h2>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <?php foreach($books as $book): ?>
        <div class="col-12 col-md-4">
                <div class="card">
                    <img src="./images/libro.jpg" class="card-img-top" alt="...">
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

