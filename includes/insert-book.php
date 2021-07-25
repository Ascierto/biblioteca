<?php
    include __DIR__ .'/Books.php';

    \Biblos\Book::insertBook($_POST,$_FILES);
?>