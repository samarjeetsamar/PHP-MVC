<?php 
include_once VIEW_BASE_PATH .'partials/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-3">

            <?php 
                include_once VIEW_BASE_PATH . '/response/success.php';
               
            ?>
            
            <b> Hello  </b>  <i> Mr. <?= $data->username ; ?> </i>
            <br>
            <form method="POST" action="<?php echo route('logout'); ?>"> 
                <input type="hidden" name="user_id" value="<?php echo $data->id; ?>">
                <button type="submit" class="mt-5 btn-danger btn-sm"> Logout </button>
            </form>
        </div>
    </div>
</div>
<?php include_once VIEW_BASE_PATH .'partials/footer.php'; ?>