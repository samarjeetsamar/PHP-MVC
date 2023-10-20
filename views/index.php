<?php
include_once 'views/partials/header.php'; 
?>

    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-primary table-bordered">
                <thead>
                    <tr>
                        <th scope="col">SR.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $val):   ?>
                    <tr>
                        <td scope="row"> <?= $key+1; ?></td>
                        <td><?= $val['username']; ?></td>
                        <td><?= $val['email']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php 
include_once 'views/partials/footer.php';
?>
