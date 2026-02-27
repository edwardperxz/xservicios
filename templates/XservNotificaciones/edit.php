<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservNotificacion $xservNotificacione
 * @var \Cake\Collection\CollectionInterface|string[] $usuarios
 * @var \Cake\Collection\CollectionInterface|string[] $clientes
 * @var \Cake\Collection\CollectionInterface|string[] $reservas
 */
$tipoNotificacionOptions = [
    'confirmacion_reserva' => 'Confirmación de Reserva',
    'asignacion_chofer' => 'Asignación de Chofer',
    'actualizacion_estado' => 'Actualización de Estado',
    'recordatorio' => 'Recordatorio',
];
$this->assign('header-title', 'Editar Notificación');
?>

<style>
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
    }
    .form-container { width: 100%; padding: 1.5rem; display: flex; justify-content: center; box-sizing: border-box; }
    .form-card { background: var(--dark-card, #1a1a1a); border-radius: 12px; padding: 2rem; border: 1px solid var(--dark-lighter, #2a2a2a); width: 100%; max-width: 1000px; box-sizing: border-box; }
    .form-header { margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid var(--dark-lighter, #2a2a2a); }
    .form-title { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-white, #ffffff); line-height: 1.3; }
    .form-subtitle { color: var(--text-gray, #a0a0a0); font-size: 0.875rem; line-height: 1.5; }
    .form-section { margin-bottom: 2rem; }
    .form-section-title { font-size: 1.1rem; color: var(--gold, #c9a962); margin-bottom: 1rem; font-weight: 600; }
    .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
    .form-group { display: flex; flex-direction: column; min-width: 0; }
    .form-label { margin-bottom: 0.5rem; color: var(--text-white, #ffffff); font-size: 0.875rem; font-weight: 500; }
    .form-label.required::after { content: ' *'; color: #e74c3c; }
    .form-input, .form-select, .form-textarea { width: 100%; padding: 0.75rem 1rem; background: var(--dark-lighter, #2a2a2a); border: 1px solid var(--dark-lighter, #2a2a2a); border-radius: 8px; color: var(--text-white, #ffffff); font-size: 0.875rem; transition: all 0.2s; box-sizing: border-box; -webkit-appearance: none; -moz-appearance: none; appearance: none; }
    .form-textarea { resize: vertical; min-height: 100px; font-family: inherit; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: var(--gold, #c9a962); background: var(--dark-bg, #0a0a0a); }
    .form-select { cursor: pointer; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23ffffff' d='M6 9L1 4h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 1rem center; padding-right: 2.5rem; }
    .form-help { margin-top: 0.25rem; font-size: 0.75rem; color: var(--text-gray, #a0a0a0); line-height: 1.4; }
    .form-actions { display: flex; gap: 1rem; justify-content: space-between; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a); flex-wrap: wrap; }
    .form-actions-left, .form-actions-right { display: flex; gap: 1rem; flex-wrap: wrap; }
    .btn { padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; transition: all 0.2s; border: none; cursor: pointer; font-size: 0.875rem; white-space: nowrap; min-width: 120px; }
    .btn-primary { background: var(--gold, #c9a962); color: var(--dark-bg, #0a0a0a); }
    .btn-primary:hover { background: var(--gold-light, #d4b978); transform: translateY(-1px); }
    .btn-secondary { background: var(--dark-lighter, #2a2a2a); color: var(--text-white, #ffffff); border: 1px solid var(--text-gray, #a0a0a0); }
    .btn-secondary:hover { background: var(--dark-card, #1a1a1a); border-color: var(--gold, #c9a962); }
    .btn-danger { background: #e74c3c; color: var(--text-white, #ffffff); }
    .btn-danger:hover { background: #c0392b; transform: translateY(-1px); }
    @media (max-width: 768px) {
        .form-container { padding: 1rem; }
        .form-card { padding: 1.5rem; border-radius: 8px; }
        .form-title { font-size: 1.25rem; }
        .form-section-title { font-size: 1rem; }
        .form-row { grid-template-columns: 1fr; gap: 1.25rem; }
        .form-actions { flex-direction: column; }
        .form-actions-left, .form-actions-right { width: 100%; flex-direction: column; }
        .btn { width: 100%; min-width: auto; }
    }
    @media (max-width: 480px) {
        .form-container { padding: 0.75rem; }
        .form-card { padding: 1rem; border-radius: 6px; }
        .form-title { font-size: 1.125rem; }
        .form-subtitle { font-size: 0.8125rem; }
        .form-section-title { font-size: 0.9375rem; }
        .form-row { gap: 1rem; }
        .form-input, .form-select, .form-textarea { padding: 0.625rem 0.875rem; font-size: 0.8125rem; }
        .form-label { font-size: 0.8125rem; }
        .form-help { font-size: 0.6875rem; }
        .btn { padding: 0.625rem 1rem; font-size: 0.8125rem; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="form-title">Editar Notificación</h2>
            <p class="form-subtitle">Modifique la notificación a usuarios o clientes</p>
        </div>

        <?= $this->Form->create($xservNotificacione) ?>
        
        <div class="form-section">
            <h3 class="form-section-title">Destinatarios</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Chofer (Usuario)</label>
                    <?= $this->Form->control('usuario_id', ['options' => $usuarios, 'empty' => 'Seleccione un usuario', 'class' => 'form-select', 'label' => false]) ?>
                    <span class="form-help">Chofer del sistema a notificar</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Cliente (Opcional)</label>
                    <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => 'Seleccione un cliente', 'class' => 'form-select', 'label' => false]) ?>
                    <span class="form-help">Cliente a notificar</span>
                </div>
                <div class="form-group">
                    <label class="form-label">Reserva (Opcional)</label>
                    <?= $this->Form->control('reserva_id', ['options' => $reservas, 'empty' => 'Seleccione una reserva', 'class' => 'form-select', 'label' => false]) ?>
                    <span class="form-help">Reserva relacionada</span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Destinatario</label>
                    <input type="text" class="form-input" value="Sistema" readonly style="background-color: var(--dark-lighter, #2a2a2a); cursor: not-allowed; opacity: 0.7;" />
                    <?= $this->Form->control('destinatario', ['type' => 'hidden', 'value' => 'sistema']) ?>
                    <span class="form-help">Las notificaciones se envían a través del panel del sistema</span>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Tipo de Notificación</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label required">Tipo de Notificación</label>
                    <?= $this->Form->control('tipo_notificacion', ['options' => $tipoNotificacionOptions, 'empty' => 'Seleccione un tipo', 'class' => 'form-select', 'label' => false, 'required' => true]) ?>
                    <span class="form-help">Categoría de la notificación</span>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Contenido</h3>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Vista previa</label>
                    <div class="form-textarea" id="contenidoPreview" style="min-height: 100px;"></div>
                    <span class="form-help">El contenido se genera automaticamente segun la plantilla. Variables: {chofer}, {reserva}</span>
                </div>
            </div>
        </div>

        <?= $this->Form->control('contenido', ['type' => 'hidden']) ?>
        <?= $this->Form->control('medio', ['type' => 'hidden', 'value' => 'sistema']) ?>

        <div class="form-actions">
            <div class="form-actions-left">
                <!-- Botón de eliminar movido fuera del formulario -->
            </div>
            <div class="form-actions-right">
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
                <?= $this->Form->button('Enviar Notificación', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        
        <?= $this->Form->end() ?>
        
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--dark-lighter, #2a2a2a);">
            <button type="button" class="btn btn-danger" id="deleteBtn" data-delete-url="<?= $this->Url->build(['action' => 'delete', $xservNotificacione->id]) ?>">Eliminar Notificación</button>
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
                
                // Obtener el token CSRF del formulario existente
                const existingForm = document.querySelector('form');
                const csrfToken = existingForm ? existingForm.querySelector('input[name="_csrfToken"]')?.value : null;
                
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

<script>
    (function() {
        const templateMap = {
            confirmacion_reserva: 'Chofer {chofer}, la reserva {reserva} ha sido confirmada.',
            asignacion_chofer: 'Se te ha asignado la reserva {reserva}. Por favor revisa los detalles.',
            actualizacion_estado: 'Actualización de estado para la reserva {reserva}.',
            'actualización_estado': 'Actualización de estado para la reserva {reserva}.',
            recordatorio: 'Recordatorio para la reserva {reserva}.',
        };

        const tipoSelect = document.querySelector('[name="tipo_notificacion"]');
        const usuarioSelect = document.querySelector('[name="usuario_id"]');
        const clienteSelect = document.querySelector('[name="cliente_id"]');
        const reservaSelect = document.querySelector('[name="reserva_id"]');
        const contenidoInput = document.querySelector('[name="contenido"]');
        const preview = document.getElementById('contenidoPreview');
        const form = document.querySelector('form');
        const submitBtn = form ? form.querySelector('button[type="submit"]') : null;

        function getSelectedText(selectEl) {
            if (!selectEl) {
                return '';
            }
            const option = selectEl.options[selectEl.selectedIndex];
            return option && option.value ? option.text.trim() : '';
        }

        function buildTemplate() {
            const tipo = tipoSelect ? tipoSelect.value : '';
            const base = templateMap[tipo] || 'Notificacion para la reserva {reserva}.';
            const choferText = getSelectedText(usuarioSelect) || 'chofer asignado';
            const reservaText = getSelectedText(reservaSelect) || 'sin reserva';
            return base
                .replace('{chofer}', choferText)
                .replace('{reserva}', reservaText);
        }

        function applyTemplate(force) {
            if (!contenidoInput || !preview) {
                return;
            }
            const current = contenidoInput.value.trim();
            if (force || !current) {
                const text = buildTemplate();
                contenidoInput.value = text;
                preview.textContent = text;
            } else {
                preview.textContent = current;
            }
        }

        function validateForm() {
            const errors = [];
            
            // Validar que al menos uno de usuario o cliente esté seleccionado
            const usuarioId = usuarioSelect ? usuarioSelect.value : '';
            const clienteId = clienteSelect ? clienteSelect.value : '';
            
            if (!usuarioId && !clienteId) {
                errors.push('Debe seleccionar al menos un Chofer o Cliente');
            }
            
            // Validar que tipo_notificacion esté seleccionado
            if (!tipoSelect || !tipoSelect.value) {
                errors.push('Debe seleccionar un tipo de notificación');
            }
            
            // Validar que contenido no esté vacío
            if (!contenidoInput || !contenidoInput.value.trim()) {
                errors.push('El contenido de la notificación es obligatorio');
            }
            
            if (errors.length > 0) {
                alert('Errores en el formulario:\n\n' + errors.join('\n'));
                return false;
            }
            
            return true;
        }

        function updateFormValidity() {
            if (!submitBtn) return;
            
            const usuarioId = usuarioSelect ? usuarioSelect.value : '';
            const clienteId = clienteSelect ? clienteSelect.value : '';
            const tipoValue = tipoSelect ? tipoSelect.value : '';
            const contenido = contenidoInput ? contenidoInput.value.trim() : '';
            
            const isValid = (usuarioId || clienteId) && tipoValue && contenido;
            submitBtn.disabled = !isValid;
            submitBtn.style.opacity = isValid ? '1' : '0.5';
            submitBtn.style.cursor = isValid ? 'pointer' : 'not-allowed';
        }

        if (tipoSelect) {
            tipoSelect.addEventListener('change', function() {
                applyTemplate(true);
                updateFormValidity();
            });
        }

        if (usuarioSelect) {
            usuarioSelect.addEventListener('change', function() {
                applyTemplate(true);
                updateFormValidity();
            });
        }

        if (clienteSelect) {
            clienteSelect.addEventListener('change', function() {
                updateFormValidity();
            });
        }

        if (reservaSelect) {
            reservaSelect.addEventListener('change', function() {
                applyTemplate(true);
                updateFormValidity();
            });
        }

        if (form) {
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                }
            });
        }

        applyTemplate(false);
        updateFormValidity();
    })();
</script>
