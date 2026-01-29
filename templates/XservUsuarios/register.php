<h1>Crear cuenta</h1>

<?= $this->Flash->render() ?>

<?= $this->Form->create($usuario) ?>
<?= $this->Form->control('name') ?>
<?= $this->Form->control('email') ?>
<?= $this->Form->control('password', ['type' => 'password']) ?>
<?= $this->Form->button('Registrarse') ?>
<?= $this->Form->end() ?>
