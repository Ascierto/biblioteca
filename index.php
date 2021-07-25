<?php

session_start();

    include __DIR__ . '/includes/header.php';

    include __DIR__ . '/includes/utils.php';

    if (isset($_GET['statocanc'])) {
        \Biblos\Utils\show_alert('cancellazione', $_GET['statocanc']);
    }elseif(isset($_GET['stato'])){
        \Biblos\Utils\show_alert('inserimento',$_GET['stato']);
    }
 

?>
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 ">
            <div class="col-12">
                <h1 class="font-weight-light">Benvenuti in Biblos</h1>
                <p class="lead">La casa del libro</p>
            </div>
            </div>
        </div>
    </header>
    



<?php include __DIR__ . '/includes/footer.php'; ?>