<?php
include __DIR__ .'/includes/header.php';
?>

<h2>Libri in uscita</h2>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="./includes/insert-rent.php">
              <div class="mb-3">
                <label for="title" class="form-label">Titolo libro</label>
                <input name="title" type="text" class="form-control" id="title" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email utente</label>
                <input name="email" type="email" class="form-control" id="email" required>
              </div>
              <div class="mb-3 form-check">
                <label for="date-start" class="form-label">Data inzio prestito</label>
                <input name="rent_start" type="date" class="form-control" id="date-start" required>
              </div>
              <div class="mb-3 form-check">
                <label for="date-end" class="form-label">Data fine prestito</label>
                <input name="rent_end" type="date" class="form-control" id="date-end" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


