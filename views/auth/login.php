<?php 
include_once 'views\partials\header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 offset-4">

            <?php 
            if(isset($_SESSION['resp'])) {
                echo '<p class="bg-danger text-white text-center p-2">'. $_SESSION['resp'] . '</p>' ;
                unset($_SESSION['resp']);
            }
            ?>

            <h3 class="text-center mb-4"> Login Form </h3>
            <form method="POST" action="<?php echo route('login') ; ?>">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" class="form-control" name="email"/>
                    <label class="form-label" for="email">Email address</label>
                </div>
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="pasword" name="password" class="form-control" />
                    <label class="form-label" for="pasword">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="form2Example31" name="rememberme_token" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </form>
        </div>   
    </div>
</div>

<?php 
include_once 'views\partials\footer.php';
?>