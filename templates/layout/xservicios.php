<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Xservicios | Transporte Turístico de Lujo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('xservicios.css') ?>

    <?= $this->Html->script('bootstrap.bundle.min.js') ?>
</head>
<body class="bg-dark text-light">

    <?= $this->element('navbar') ?>

    <main>
        <?= $this->fetch('content') ?>
    </main>

    <?= $this->element('footer') ?>

</body>
</html>
