<?php 
include_once 'views\partials\header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-3">
            <p class="bg-success text-white p-2"> You are logged In ! </p>
            <b> Mr. </b>  <?php  echo $_SESSION['username'] ; ?>
            <br>
            <form method="POST" action="<?php echo route('logout'); ?>"> 
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <button type="submit" class="mt-3 btn-primary"> Logout </button>
            </form>
            
        </div>
    </div>
</div>
<?php include_once 'views\partials\footer.php'; ?>