<h1>Users work!</h1>
<?php foreach ($users as $user) : ?>

    <p><?= $user->getId() ?> <?= $user->getName() ?></p>

<?php endforeach; ?>

<?= $singleUser->getName() ?>