<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./View/css/navbar.css">
    <link rel="stylesheet" href="./View/css/global.css">
    <link rel="stylesheet" href="./View/css/listing.css">
</head>
<body>
    
    <?php include("Fragments/header.php") ?>

    <main>
        <h1>Advertisements</h1>
        <section class="add">
            <form action="/advertisements/add" method="POST">
                <input type="number" name="id" placeholder="ID">
                <input type="text" name="userId" placeholder="UserId">
                <input type="text" name="title" placeholder="Title">
                <input type="submit" value="Save">
                <?php if (isset($failed)) : ?>
                    <p style="color:red;">Name not given</p>
                <?php endif; ?>
            </form>
        </section>
        <section class="wrapper">

            <?php foreach ($adds as $add) : ?>
                <div>
                    <p><?= $add->getId() ?></p>
                    <p class="name"><?= $add->getUserId() ?></p>
                    <p><?= $add->getTitle() ?></p>
                </div>
            
            <?php endforeach; ?>

        </section>
    </main>

    <?php include("Fragments/footer.php") ?>

</body>
</html>
