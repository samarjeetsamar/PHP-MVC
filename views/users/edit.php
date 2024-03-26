<?php
include_once 'views/partials/header.php'; 
?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-4">

                <?php 
                
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show">'. $_SESSION['success'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
                    unset($_SESSION['success']);
                }

                ?>

                <?php if(isset($_SESSION['errors'])) { 
                    $errors = $_SESSION['errors']; ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul class="list-unstyled">
                        <?php foreach ($errors as $errorMessages )  {
                            foreach($errorMessages as $errorMsg) { ?>
                            <li> <?= $errorMsg ?> </li>
                            <?php }
                        } ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php 
                    unset($_SESSION['errors']);
                } 
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
include_once 'views/partials/footer.php';
?>