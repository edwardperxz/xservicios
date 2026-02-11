<?php
/**
 * Xservicios Frontend Layout - Clean rendering without CakePHP UI
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?: 'Xservicios' ?></title>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->fetch('content') ?>
</body>
</html>
