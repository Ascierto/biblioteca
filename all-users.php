<?php


include __DIR__ . '/includes/Users.php';

include __DIR__ .'/includes/header.php';

$users= \Biblos\Users::showUsers();
 
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Cognome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Password</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($users as $user): ?>
                <tr>
                  <th scope="row"><?php echo $user['id'] ?></th>
                  <td><?php echo $user['name'] ?></td>
                  <td><?php echo $user['surname'] ?></td>
                  <td><?php echo $user['email'] ?></td>
                  <td><?php echo $user['password'] ?></td>
                </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
        </div>
    </div>
</div>
