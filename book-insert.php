<?php
session_start();

if (!isset($_SESSION['is_admin'])) {
  header('Location: http://localhost:8888/biblioteca/login.php');
}elseif ($_SESSION['is_admin'] == 0){
  header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/utils.php';

if (isset($_GET['stato'])) {
  \Biblos\Utils\show_alert('inserimento', $_GET['stato']);
}

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="./includes/insert-book.php" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input name="title" type="text" class="form-control" id="title" required>
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Descrizione</label>
                <textarea name="description" cols="30" rows="4" class="form-control" id="desc"></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Copertina</label>
                <input name="cover" type="file" class="form-control" id="image">
            </div>
            <div class="mb-3">
              <label for="published" class="form-label">Anno pubblicazione</label>
              <input name="published_year" type="number" minlength="0" maxlength="4" class="form-control" id="published">
            </div>
              <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input name="price" type="number" step=0.01 class="form-control" id="price" required>
              </div>
              <div class="mb-3">
                <label for="editor" class="form-label">Casa editrice</label>
                <input name="editor" type="text" class="form-control" id="editor">
              </div>
              <div class="mb-3">
              <label class="form-label">Seleziona disponibilità</label>
                    <select name="available" class="form-select" required>
                       <option value="1">Disponibile</option>
                       <option value="0">Non disponibile</option>        
                    </select> 
             </div>
             <div class="mb-3">
                <label for="author_name" class="form-label">Nome Autore</label>
                <input name="author_name" type="text" class="form-control" id="author_name" required>
              </div>
              <div class="mb-3">
                <label for="author_bio" class="form-label">Bio Autore</label>
                <textarea name="author_bio" id="author_bio" cols="30" rows="4" class="form-control"></textarea>
              </div>
            
             
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>