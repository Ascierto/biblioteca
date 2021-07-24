<?php
 
 include __DIR__ . '/Users.php';

 if(isset($_GET['id'])){
     \Biblos\Users::updateUser($_POST,$_GET['id']);
 }

?>