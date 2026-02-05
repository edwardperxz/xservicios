<h1>Mi Perfil</h1>

<p><strong>Nombre:</strong> <?= h($user->username) ?></p>
<p><strong>Rol:</strong> <?= h($user->rol) ?></p>

<?php if ($user->rol === 'admin'): ?>
    <h2>Acciones de Administrador</h2>
    <div class="actions">
        <?= $this->Html->link('Gestionar Usuarios', ['controller' => 'XservUsuarios', 'action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Html->link('Gestionar Reservas', ['controller' => 'XservReservas', 'action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Html->link('Reportes', ['controller' => 'Reportes', 'action' => 'index'], ['class' => 'button']) ?>
    </div>
<?php endif; ?>

<?php if ($user->rol === 'operador'): ?>
    <h2>Acciones de Operador</h2>
    <div class="actions">
        <?= $this->Html->link('Ver Reservas Pendientes', ['controller' => 'XservReservas', 'action' => 'pendientes'], ['class' => 'button']) ?>
        <?= $this->Html->link('Crear Reserva', ['controller' => 'XservReservas', 'action' => 'add'], ['class' => 'button']) ?>
    </div>
<?php endif; ?>

<?php if ($user->rol === 'chofer'): ?>
    <h2>Acciones de Chofer</h2>
    <p><strong>Teléfono:</strong> <?= h($chofer->telefono) ?></p>
    <p><strong>Licencia:</strong> <?= h($chofer->tipo_licencia) ?></p>
    <div class="actions">
        <?= $this->Html->link('Mis Asignaciones', ['controller' => 'XservAsignaciones', 'action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Html->link('Actualizar Estado', ['controller' => 'XservAsignaciones', 'action' => 'updateStatus'], ['class' => 'button']) ?>
    </div>
<?php endif; ?>

<?= $this->Html->link('Cambiar Contraseña', ['action' => 'changePassword'], ['class' => 'button']) ?>


<?= $this->Form->postLink('Cerrar sesión', ['controller' => 'XservUsuarios', 'action' => 'logout'], ['class' => 'logout-link']) ?>

