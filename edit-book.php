<?php

session_start();

if (!isset($_SESSION['is_admin'])) {
  header('Location: http://localhost:8888/biblioteca/login.php');
}elseif ($_SESSION['is_admin'] == 0){
  header('Location: http://localhost:8888/biblioteca/?stato=errore&messages=Impossibile accedere');
}

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/Books.php';

$data=array(
    'id'=>$_GET['id']
);

$book = \Biblos\Book::selectBook($data);
 
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="./includes/update-book.php?id=<?php echo $_GET['id']; ?>">
              <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input name="title" type="text" class="form-control" id="title" value="<?php echo $book[0]['title'] ?>">
              </div>
              <div class="mb-3">
                <label for="desc" class="form-label">Descrizione</label>
                <textarea name="description" cols="30" rows="4" class="form-control" id="desc"><?php echo $book[0]['description'] ?></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Copertina</label>
                <input name="cover" type="file" class="form-control" id="image">
            </div>
            <div class="mb-3">
              <label for="published" class="form-label">Anno pubblicazione</label>
              <input name="published_year" type="number" minlength="0" maxlength="4" class="form-control" id="published" value="<?php echo $book[0]['published_year'] ?>">
            </div>
              <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input name="price" type="number" step=0.01 class="form-control" id="price" value="<?php echo $book[0]['price'] ?>">
              </div>
              <div class="mb-3">
                <label for="editor" class="form-label">Casa editrice</label>
                <input name="editor" type="text" class="form-control" id="editor" value="<?php echo $book[0]['editor'] ?>">
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
                <input name="author_name" type="text" class="form-control" id="author_name" value="<?php echo $book[0]['author_name'] ?>">
              </div>
              <div class="mb-3">
                <label for="author_bio" class="form-label">Bio Autore</label>
                <textarea name="author_bio" id="author_bio" cols="30" rows="4" class="form-control"><?php echo $book[0]['author_bio'] ?></textarea>
              </div>
            
             
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>