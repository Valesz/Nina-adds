<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nina - Users</title>
    <link rel="stylesheet" href="./View/css/navbar.css">
    <link rel="stylesheet" href="./View/css/global.css">
    <link rel="stylesheet" href="./View/css/listing.css">
</head>
<body>
    <?php include "Fragments/header.php" ?>
    
    <main>
        <h1>Users</h1>
        <section class="add">
            <form action="/users/add" method="POST">
                <input type="number" name="id" placeholder="ID">
                <input type="text" name="name" placeholder="Name">
                <input type="submit" value="Save">
                <?php if (isset($failed)) : ?>
                    <p style="color:red;">Failed to save</p>
                <?php endif; ?>
            </form>
        </section>
        <section class="wrapper">


            <?php foreach ($users as $user) : ?>
                <div>
                    <p><?= $user->getId() ?></p>
                    <p class="name"><?= $user->getName() ?></p>
                    <form action="/users/remove" method="POST">
                        <input type="hidden" name="id" value="<?= $user->getId() ?>">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            
            <?php endforeach; ?>

        </section>
    </main>
    
    <?php include "Fragments/footer.php" ?>
</body>
</html>