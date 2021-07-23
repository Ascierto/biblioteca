<?php
 
 include __DIR__ . '/Books.php';

 if(isset($_GET['id'])){
     \Biblos\Book::updateBook($_POST,$_GET['id']);
 }

?>