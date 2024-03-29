<?php 
include_once VIEW_BASE_PATH. 'partials/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-4">
            <h1 class="text-center mb-5"> Registration Form </h1>

            <?php if (isset($_SESSION['flash']['success'])) : ?>
                <div class="alert alert-success" role="alert">  <?=  $_SESSION['flash']['success']; ?> </div>
            <?php elseif(isset($_SESSION['flash']['error'])) : ?>
                <div class="alert alert-danger" role="alert">  <?=  $_SESSION['flash']['error']; ?> </div>
            <?php endif;   unset($_SESSION['flash']);  ?>


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

            
            <form method="POST" action="<?= route('register'); ?>">
                <div class="mb-3">
                    <label for="name" class="form-label font-weight-bold">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="name" name="username">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-4 m-auto">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="10000">
  <div role="alert" aria-live="assertive" aria-atomic="true">...</div>
</div>

<?php 
include_once VIEW_BASE_PATH. 'partials/footer.php';
?>
    