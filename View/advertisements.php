<h1>Advertisements works!</h1>

<?php foreach($adds as $add) : ?>

    <p><?= $add->getId() ?> <?= $add->getUserId() ?> <?= $add->getTitle() ?></p>

<?php endforeach; ?>

<?= $singleAdd->getTitle() ?>
