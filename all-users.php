<?php

session_start();


if (!isset($_SESSION['is_admin'])) {
  header('Location: http://localhost:8888/biblioteca/login.php');
}elseif ($_SESSION['is_admin'] == 0){
  header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
}

include __DIR__ . '/includes/Users.php';

include __DIR__ .'/includes/header.php';

include __DIR__ . '/includes/utils.php';

if (isset($_GET['statocanc'])) {
  \Biblos\Utils\show_alert('cancellazione', $_GET['statocanc']);
}

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
                  <th scope="col">Modifica</th>
                  <th scope="col">Elimina</th>
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
                  <td><a href="./edit-user.php?id=<?php echo $user['id'] ?>">✏️</a></td>
                  <td><a href="./includes/softdelete-user.php?id=<?php echo $user['id'] ?>">❌</a></td>
                </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>