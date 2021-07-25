<?php

include __DIR__ . '/includes/header.php';

include __DIR__ . '/includes/utils.php';

if (isset($_GET['stato'])) {
    \Biblos\Utils\show_alert('inserimento', $_GET['stato']);
    
  }

?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Accedi</h2>
        </div>
        <div class="col-12">
            <form method="POST" action="./includes/login.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include __DIR__ . '/includes/footer.php'; ?>