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

                <h3 class="mb-3"> <?= $post->title; ?> </h3>
                
                <div class="mb-5">
                    <span>Written by ----</span>
                    <span class="badge bg-primary">  <?= $post->username; ?> </span>
                    <div> Published At <span class="badge bg-secondary"> <?= \Carbon\Carbon::parse($post->created_at)->diffForHumans(); ?> </span> </div>
                </div>

                <p> <?= $post->body; ?> </p>
                
            </div>
        </div>
    </div>
<?php 
include_once  VIEW_BASE_PATH. '/partials/footer.php';
?>