<?php
include __DIR__ . '/Books.php';

if(isset($_GET['id'])){
    \Biblos\Book::deleteBook($_GET['id']);
}

?>