<?php
include_once VIEW_BASE_PATH. '/partials/header.php'; 
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-2">

                <?php 
                include_once VIEW_BASE_PATH . '/response/success.php';
                include_once VIEW_BASE_PATH . '/response/error.php'; 
                include_once VIEW_BASE_PATH . '/response/validation.php';   
                ?>

                <h3> Add Post Details Here! </h3>
                <form method="POST" action="<?= route('post.store'); ?>">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"/>
                    </div>
                    <div class="mb-3">
                        <label >Body</label>
                        <textarea rows="15" name="body" id="article" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </div>

<?php 

include_once  VIEW_BASE_PATH. '/partials/footer.php';
?>