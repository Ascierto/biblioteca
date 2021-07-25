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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Benvenuti in Biblos</h1>
                <p>La casa del libro</p>
            </div>
        </div>
    </div>



<?php include __DIR__ . '/includes/footer.php'; ?>