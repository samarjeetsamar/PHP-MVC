<?php

if (isset($_SESSION['error'])) :
    echo '<div class="alert alert-warning alert-dismissible fade show">'. $_SESSION['error'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    unset($_SESSION['error']);
endif;