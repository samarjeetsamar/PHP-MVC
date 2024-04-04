<?php
include_once VIEW_BASE_PATH. '/partials/header.php'; 
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-4">

            <div class=" d-flex flex-wrap mb-4">
                    <div class="card card-body flex-fill shadow-lg">
                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                    
                    <?php if(isset($data) ) : ?> 
                        <h4 class="card-title mb-4"> <?=  $data->username; ?> </h4>
                        <p> <?= $data->email; ?> </p>
                    <?php endif; ?>
                    
                </div>
            </div>

               
            </div>
        </div>
    </div>
<?php 
include_once  VIEW_BASE_PATH. '/partials/footer.php';
?>