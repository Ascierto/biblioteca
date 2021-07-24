<?php
include __DIR__ . '/Users.php';

if(isset($_GET['id'])){

    \Biblos\Users::softDeleteUser($_GET['id']);
}



?>