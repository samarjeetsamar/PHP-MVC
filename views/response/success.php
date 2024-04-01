<?php

if (isset($_SESSION['success'])) :
    echo '<div class="alert alert-success alert-dismissible fade show">'. $_SESSION['success'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    unset($_SESSION['success']);
endif;