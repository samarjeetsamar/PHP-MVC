<?php 
include_once 'views/partials/header.php';
?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-2">
                <?php 
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show">'. $_SESSION['success'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
                    unset($_SESSION['success']);
                }
                ?>
                <h1> All Users </h1>
                <div class="">
                    <table class="table table-primary table-sm">
                        <thead>
                            <tr>
                                <th scope="col">SR. NO.</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($data) && count($data)  > 0 ) : ?> 
                            <?php foreach($data as $key => $val) : ?>
                                <tr class="">
                                    <td scope="row"><?= $key+1; ?></td>
                                    <td> <?=  $val['username']; ?> </td>
                                    <td><?= $val['email']; ?></td>
                                    <td> <a href="<?php echo route('user.edit', ['id'=> $val['id']]); ?>">Edit   </a> <a href="<?php echo route('user.delete', ['id'=> $val['id']]); ?> "> Delete </a> </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
<?php 
include_once 'views/partials/footer.php';