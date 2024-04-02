<?php
include_once VIEW_BASE_PATH. '/partials/header.php'; 
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-3">

                <?php 
                include_once VIEW_BASE_PATH . '/response/success.php';
                include_once VIEW_BASE_PATH . '/response/error.php'; 
                include_once VIEW_BASE_PATH . '/response/validation.php';   
                ?>

                <a class="btn btn-primary mb-5" href="<?= route('home') ?>"> All Posts </a>

                <h3 class="mb-5"> <?= $post->title; ?> </h3>
                <p> <?= $post->body; ?> </p>
                
            </div>
        </div>
    </div>
<?php 
include_once  VIEW_BASE_PATH. '/partials/footer.php';
?>