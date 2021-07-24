<?php

    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/includes/Rent.php';

    $rents= \Biblos\Rent::showRents();

  
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
                </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
        </div>
    </div>
</div>