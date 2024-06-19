<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./View/css/navbar.css">
    <link rel="stylesheet" href="./View/css/global.css">
    <link rel="stylesheet" href="./View/css/home.css">
</head>
<body>
    
    <?php include "Fragments/header.php" ?>

    <main>
        <section>
            <h1>Manage Users</h1>
            <p>Insert new users into your system, or check out those who are already registered!</p>
            <a href="/users"><button>View Users</button></a>
        </section>
        <section>
            <h1>Manage Adds</h1>
            <p>Insert new adds into your system, or check out existing ones!</p>
            <a href="/advertisements"><button>View Adds</button></a>
        </section>
    </main>

    <?php include "Fragments/footer.php" ?>

</body>
</html>