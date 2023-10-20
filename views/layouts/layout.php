<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->getTitle(); ?></title>
</head>
<body>
    <?php include('../partials/header.php'); ?>

    <?php echo $this->getContent(); ?>

    <?php include('../partials/footer.php'); ?>
</body>
</html>