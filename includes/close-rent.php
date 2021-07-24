<?php
include __DIR__ . '/Rent.php';

if(isset($_GET['id'])){

    \Biblos\Rent::closeRent($_GET['id']);
}

//fai tornare disponibile il libro
?>