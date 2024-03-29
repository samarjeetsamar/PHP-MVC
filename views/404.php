<?php 
include_once VIEW_BASE_PATH.'partials/header.php';
?>

<div class="container mt-5 text-center">
    <div class="row">
        <div class="col-lg-12">
                <h1> <?= $code ?> Not Found</h1>
                <p><?= $errorMsg ?> </p>
        </div>
    </div>
</div>
 
<?php include_once VIEW_BASE_PATH.'partials/footer.php'; ?>