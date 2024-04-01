<?php
include_once VIEW_BASE_PATH. '/partials/header.php'; 
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-4">

                <?php 
                include_once VIEW_BASE_PATH . '/response/success.php';
                include_once VIEW_BASE_PATH . '/response/error.php'; 
                include_once VIEW_BASE_PATH . '/response/validation.php';   
                ?>

                <h3> Update User Details </h3>
                <form method="POST" action="<?= route('user.update', ['id' =>$user->id]); ?>">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="username"  value="<?= $user->username; ?>">
                    </div>
                    <div class="mb-3">
                        <label >Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $user->email; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php 
include_once  VIEW_BASE_PATH. '/partials/footer.php';
?>