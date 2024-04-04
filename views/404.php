<?php 
include_once VIEW_BASE_PATH.'partials/header.php';
?>

<div class="container mt-5 text-center">
    <div class="row">
        <div class="col-lg-12">
                <h1 style="font-size: 52px; margin-bottom: 30px;"> <?= $code ?> </h1>
                <h2 class="mb-4"> Oops! Page Not Found</h2>
                <p style="font-size: 18px; max-width: 700px; margin: 0 auto;"><?= $errorMsg ?> </p>
                <a class="btn btn-primary mt-5" href="<?= route('home'); ?>"> Back to home page </a>
        </div>
    </div>
</div>
 
<?php include_once VIEW_BASE_PATH.'partials/footer.php'; ?>