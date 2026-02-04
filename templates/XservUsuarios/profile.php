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
    <div class="actions">
        <?= $this->Html->link('Mis Asignaciones', ['controller' => 'XservAsignaciones', 'action' => 'index'], ['class' => 'button']) ?>
        <?= $this->Html->link('Actualizar Estado', ['controller' => 'XservAsignaciones', 'action' => 'updateStatus'], ['class' => 'button']) ?>
    </div>
<?php endif; ?>

<a href="<?= $this->Url->build(['controller' => 'XservUsuarios', 'action' => 'logout']) ?>" class="user-profile" style="text-decoration: none;">
                    <div class="user-avatar">US</div>
                    <span class="user-name">cerrar sesión</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </a>
