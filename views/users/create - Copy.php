<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-3">
                <h1 class="text-center"> Add User Form </h1>

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

                
                <form method="POST" action="<?php echo route('add.User'); ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>