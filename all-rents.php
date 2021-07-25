<?php

session_start();


if (!isset($_SESSION['is_admin'])) {
  header('Location: http://localhost:8888/biblioteca/login.php');
}elseif ($_SESSION['is_admin'] == 0){
  header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
}
    include __DIR__ . '/includes/header.php';

    include __DIR__ . '/includes/Rent.php';

    include __DIR__ . '/includes/utils.php';

    $rents= \Biblos\Rent::showRents();

    if (isset($_GET['statocanc'])) {
      \Biblos\Utils\show_alert('cancellazione', $_GET['statocanc']);
  }

  
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
                  <th scope="col">Libro</th>
                  <th scope="col">Inizio Prestito</th>
                  <th scope="col">Fine prestito</th>
                  <th scope="col">Disponibilità</th>
                  <th scope="col">Articolo rientrato</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($rents as $rent): ?>
                <tr>
                  <th scope="row"><?php echo $rent['id'] ?></th>
                  <td><?php echo $rent['name'] ?></td>
                  <td><?php echo $rent['surname'] ?></td>
                  <td><?php echo $rent['title'] ?></td>
                  <td><?php echo implode('-', array_reverse(explode('-',$rent['rent_start']))) ?></td> 
                  <td><?php echo implode('-', array_reverse(explode('-',$rent['rent_end']))) ?></td>
                  <td><?php $rent['available']== 0 ? printf('🔴'):printf('🟢') ?></td> 
                  <td><a href="./includes/close-rent.php?id=<?php echo $rent['id'] ?>" class="btn btn-outline-light rounded">✔️</a></td>
                </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>