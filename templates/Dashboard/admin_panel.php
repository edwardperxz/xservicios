<h1>Panel de Administrador</h1>
<p>Bienvenido, <?= h($user->nombre ?? $user->username ?? 'Usuario') ?></p>
<?= $this->Form->postLink('Cerrar sesion', ['controller' => 'XservUsuarios', 'action' => 'logout'], ['class' => 'button']) ?>
