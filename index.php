<?php

session_start();

    include __DIR__ . '/includes/header.php';

 
 

?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Benvenuti in Biblos</h1>
                <p>La casa del libro</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <!-- predispongo il form che fa partire funzione di ricerca che va in una pag visibile a tutti i loggati su autori e poi faccio lo stesso per titoli -->
            <!-- oppure metto il filtro nella pagina tutti i libri e lo creo come i bottoni altrimenti prova con input che da su link ed il link prende come q ciò che è scritto -->
            <div class="col-12 col-md-6 text-center">
                <h2>Cerca libro per titolo</h2>
                <form class="d-flex" method="POST" action="./search-title.php">
                    <input name="q" class="form-control me-2" type="search" placeholder="Cerca titolo" aria-label="Cerca">
                    <button class="btn btn-outline-success" type="submit">Cerca</button>
                </form>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/includes/footer.php'; ?>