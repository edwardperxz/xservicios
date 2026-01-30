<h1>Crear cuenta</h1>
<?= $this->Flash->render() ?>
<?= $this->Form->create($usuario) ?>
<?= $this->Form->control('username', [
    'label' => 'Usuario o correo'
]) ?>
<?= $this->Form->control('password', [
    'type' => 'password',
    'label' => 'Contraseña'
]) ?>
<?= $this->Form->button('Registrarse') ?>
<?= $this->Form->end() ?>
