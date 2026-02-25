<h1>Panel de Operador</h1>
<p>Bienvenido, <?= h($user->username ?? 'Usuario') ?></p>
<?= $this->Form->postLink('Cerrar sesion', ['controller' => 'XservUsuarios', 'action' => 'logout'], ['class' => 'button']) ?>
