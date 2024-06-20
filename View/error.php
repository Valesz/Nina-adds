<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nina - Error</title>
    <link rel="stylesheet" href="./View/css/navbar.css">
    <link rel="stylesheet" href="./View/css/global.css">
    <link rel="stylesheet" href="./View/css/listing.css">
</head>
<body>
    
    <?php include "Fragments/header.php" ?>

    <main>
        <h1><?= isset($code) ? $code : "" ?> <?= isset($title) ? $title : "" ?></h1>
        <p><?= isset($description) ? $description : "" ?></p>
    </main>

    <?php include "Fragments/footer.php" ?>

</body>
</html>
