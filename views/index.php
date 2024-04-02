<?php
include_once VIEW_BASE_PATH . 'partials/header.php'; 
?>

    <div class="container my-3">
        <h3 class="text-center my-5"> Welcome to Home page !!! </h3>
        <div class="text-center mb-5">
            <a class="btn btn-primary" href="<?php echo route('post.create'); ?>"> Create Post </a>
        </div>


        <div class="container-fluid">
            <div class="row">

            <?php if(isset($data) && count($data) > 0) : ?>
            <?php foreach($data as $post) : ?>
                <div class="col-md-4  d-flex flex-wrap mb-4">
                    <div class="card card-body flex-fill shadow-lg">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    
                    <h4 class="card-title mb-4"> <a class="text-decoration-none text-primary" href="<?= route('post.show', ['slug' => $post['slug']] ); ?>"> <?= $post['title']; ?> </a> </h4>
                    <p class="card-text"><?=  $post['body']; ?></p>
                    
                </div>
            </div>
            <?php endforeach ?>
            <?php endif ?>

                
                
            </div>
        </div>
       

    </div>
<?php 
include_once VIEW_BASE_PATH .'partials/footer.php';
?>
