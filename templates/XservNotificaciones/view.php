<?php
$this->assign('header-title', 'Detalle de Notificación');
?>

<style>
:root { --gold: #c9a962; --gold-light: #d4b978; --dark-bg: #0a0a0a; --dark-card: #1a1a1a; --dark-lighter: #2a2a2a; --text-white: #ffffff; --text-gray: #a0a0a0; --red: #ef4444; --blue: #3b82f6; --green: #4ade80; } .view-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; } .view-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; } .view-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; } .view-title { font-size: 1.5rem; font-weight: 600; color: var(--text-white, #ffffff); } .view-actions { display: flex; gap: 0.75rem; flex-wrap: wrap; } .btn { padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; } .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); } .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); } .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); } .btn-secondary:hover { border-color: var(--gold, #c9a962); } .btn-danger { background: var(--red, #ef4444); color: var(--text-white, #ffffff); } .btn-danger:hover { background: #dc2626; transform: translateY(-1px); } .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; } .detail-item { background: var(--dark-lighter, #2a2a2a); padding: 1rem; border-radius: 8px; } .detail-label { font-size: 0.75rem; color: var(--text-gray, #a0a0a0); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; } .detail-value { font-size: 1rem; color: var(--text-white, #ffffff); font-weight: 500; word-break: break-word; } .detail-value a { color: var(--gold, #c9a962); text-decoration: none; } .detail-value a:hover { text-decoration: underline; } @media (max-width: 768px) { .view-container { padding: 1rem; } .view-card { padding: 1.5rem; } .view-title { font-size: 1.25rem; } .view-header { flex-direction: column; align-items: flex-start; } .view-actions { width: 100%; } .btn { width: 100%; } .detail-grid { grid-template-columns: 1fr; gap: 1rem; } } @media (max-width: 480px) { .view-container { padding: 0.75rem; } .view-card { padding: 1rem; } .view-title { font-size: 1.125rem; } .btn { padding: 0.5rem 1rem; font-size: 0.8125rem; } }
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">Notificación: <?= h($xservNotificacione->tipo_notificacion) ?></h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservNotificacione->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                <button type="button" class="btn btn-danger" id="deleteBtn" data-delete-url="<?= $this->Url->build(['action' => 'delete', $xservNotificacione->id]) ?>">Eliminar</button>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Usuario</div>
                <div class="detail-value">
                    <?= $xservNotificacione->hasValue('usuario') && !empty($xservNotificacione->usuario->username)
                        ? $this->Html->link($xservNotificacione->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservNotificacione->usuario->id])
                        : $this->Html->tag('span', 'No asignado', ['style' => 'color: #6b7280;']) ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Cliente</div>
                <div class="detail-value">
                    <?= $xservNotificacione->hasValue('cliente') && !empty($xservNotificacione->cliente->nombre)
                        ? $this->Html->link($xservNotificacione->cliente->nombre, ['controller' => 'XservClientes', 'action' => 'view', $xservNotificacione->cliente->id])
                        : $this->Html->tag('span', 'No asignado', ['style' => 'color: #6b7280;']) ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Reserva</div>
                <div class="detail-value">
                    <?= $xservNotificacione->hasValue('reserva') && !empty($xservNotificacione->reserva->codigo_reserva)
                        ? $this->Html->link($xservNotificacione->reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservNotificacione->reserva->id])
                        : $this->Html->tag('span', 'No asignado', ['style' => 'color: #6b7280;']) ?>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Tipo Notificación</div>
                <div class="detail-value"><?= h($xservNotificacione->tipo_notificacion) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Medio</div>
                <div class="detail-value"><?= h($xservNotificacione->medio) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Destinatario</div>
                <div class="detail-value"><?= h($xservNotificacione->destinatario) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado Envío</div>
                <div class="detail-value"><?= h($xservNotificacione->estado_envio) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Enviado At</div>
                <div class="detail-value"><?= h($xservNotificacione->enviado_at) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Contenido</div>
                <div class="detail-value"><?= h($xservNotificacione->contenido) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Error Log</div>
                <div class="detail-value"><?= h($xservNotificacione->error_log) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación de eliminación -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: var(--dark-card, #1a1a1a); border: 1px solid var(--dark-lighter, #2a2a2a); border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%;">
        <h3 style="color: var(--text-white, #ffffff); margin-top: 0; margin-bottom: 1rem;">Confirmar Eliminación</h3>
        <p style="color: var(--text-gray, #a0a0a0); margin-bottom: 1.5rem; line-height: 1.6;">¿Está seguro de eliminar esta notificación? Esta acción no se puede deshacer.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: flex-end; flex-wrap: wrap;">
            <button type="button" class="btn btn-secondary" id="cancelDeleteBtn">Cancelar</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
        </div>
    </div>
</div>

<script>
    (function() {
        const deleteBtn = document.getElementById('deleteBtn');
        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const modal = document.getElementById('deleteModal');

        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'flex';
            });
        }

        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', function() {
                deleteModal.style.display = 'none';
            });
        }

        if (confirmDeleteBtn) {
            confirmDeleteBtn.addEventListener('click', function() {
                const url = deleteBtn.getAttribute('data-delete-url');
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                
                // Obtener el token CSRF del documento (está en meta o en formulario existente)
                let csrfToken = document.querySelector('meta[name="_csrfToken"]')?.getAttribute('content');
                
                // Si no está en meta, buscar en formulario existente
                if (!csrfToken) {
                    csrfToken = document.querySelector('form input[name="_csrfToken"]')?.value;
                }
                
                // Agregar el token CSRF
                if (csrfToken) {
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_csrfToken';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
                }
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_method';
                input.value = 'DELETE';
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            });
        }

        // Cerrar modal al hacer clic fuera de él
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    })();
</script>