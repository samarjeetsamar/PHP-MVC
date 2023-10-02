<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Column 1</th>
                    <th scope="col">Column 2</th>
                    <th scope="col">Column 3</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">R1C1</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                </tr>
                <?php if(isset($data) && count($data)  > 0 ) : ?> 
                <?php foreach($data as $key => $val) : ?>
                    <tr class="">
                        <td scope="row"><?= $key+1; ?></td>
                        <td> <?=  $val['username']; ?> </td>
                        <td><?= $val['email']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>