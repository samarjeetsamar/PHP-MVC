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
                <h3 class="mb-5"> Users Registered in Website </h3>
                <div class="">
                    <table class="table table-primary">
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
                                    <td> 
                                        <a class="btn btn-sm" href="<?php echo route('user.edit', ['id'=> $val['id']]); ?>"><i class="fas fa-edit"></i>   </a> 
                                        
                                        <a href="<?php echo route('user.delete', ['id'=> $val['id']]); ?> "> <i class="fa fa-trash text-danger" aria-hidden="true"></i> </a> </td>
                                    
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