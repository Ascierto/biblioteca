<?php

session_start();

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/Books.php';

$data=array(
    'id'=>$_GET['id']
);

$book = \Biblos\Book::selectBook($data);

 
?>

<section class="container my-5">
    <div class="row">
        <div class="col-12 text-end">
            <?php if($_SESSION['is_admin'] == 1) :?>
            <a href="edit-book.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-warning">Modifica</a>
            <a href="./includes/delete-book.php?id=<?php echo $_GET['id'];?>" class="btn btn-outline-danger">Elimina</a>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <h1> <?php echo $book[0]['title'] ?></h1>
            <p> # <?php echo $_GET['id'] ?></p>
        </div>
        <div class="col-12 col-md-6">
        <?php if($book[0]['cover']): ?>
            <img src="./images/<?php echo $book[0]['cover'] ?>" class="card-img-top img-fluid" alt="...">
        <?php else :?>
            <img src="./images/libro.jpg" class="card-img-top img-fluid" alt="...">
        <?php endif?>
        </div>
        <div class="col-12 col-md-6">
            <p>Descrizione :<?php echo $book[0]['description'] ?></p>
            <p><?php echo $book[0]['published_year'] ?></p>
            <p>€<?php echo $book[0]['price'] ?></p>
            

            <p>Autore : <?php echo $book[0]['author_name'] ?></p>
            <p>Bio Autore : <?php echo $book[0]['author_bio'] ?></p>

            <h5> Disponibile <?php $book[0]['available']== 0 ? printf('🔴'):printf('🟢') ;?> </h5>
        </div>
    </div>

</section>
