<?php

if(isset($_SESSION['errors'])) { 
    $errors = $_SESSION['errors']; ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul class="list-unstyled">
            <?php foreach ($errors as $errorMessages ) :

            if(is_array($errorMessages)) :
                foreach($errorMessages as $errorMsg) : ?>
                        <li> <?= $errorMsg ?> </li>
                <?php  endforeach ?>
               <?php else : ?>
                <li> <?= $errorMessages ?> </li>
            <?php endif ?>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php 
    unset($_SESSION['errors']);
} 