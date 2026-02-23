<h1>Cambiar Contraseña</h1>

<?= $this->Form->create(null) ?>
    <?= $this->Form->control('current_password', ['type' => 'password', 'label' => 'Contraseña actual']) ?>
    <?= $this->Form->control('new_password', ['type' => 'password', 'label' => 'Nueva contraseña']) ?>
    <?= $this->Form->control('confirm_password', ['type' => 'password', 'label' => 'Confirmar nueva contraseña']) ?>
    <?= $this->Form->button('Actualizar Contraseña') ?>
<?= $this->Form->end() ?>
