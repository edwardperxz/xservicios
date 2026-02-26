<?php
$this->assign('header-title', 'Detalle de Servicio');
$authUser = $this->request->getAttribute('identity');
$isAdmin = $authUser && $authUser->rol === 'admin';
?>

<style>
    :root {
        --gold: #c9a962;
        --gold-light: #d4b978;
        --gold-soft: rgba(201, 169, 98, 0.2);
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --dark-lighter: #2a2a2a;
        --text-white: #ffffff;
        --text-gray: #a0a0a0;
        --text-muted: #7a7a7a;
        --red: #ef4444;
        --green: #4ade80;
    }

    * {
        box-sizing: border-box;
    }

    .view-container {
        width: 100%;
        padding: 2rem 1.5rem;
        display: flex;
        justify-content: center;
    }

    .view-card {
        width: 100%;
        max-width: 1040px;
        background: radial-gradient(circle at top, rgba(201, 169, 98, 0.12), transparent 55%), var(--dark-card, #1a1a1a);
        border-radius: 18px;
        padding: 2.25rem;
        border: 1px solid rgba(201, 169, 98, 0.2);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.45);
    }

    .view-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.25rem;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--dark-lighter, #2a2a2a);
        margin-bottom: 1.5rem;
    }

    .view-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: var(--text-white, #ffffff);
    }

    .view-subtitle {
        font-size: 0.875rem;
        color: var(--text-muted, #7a7a7a);
        margin-top: 0.35rem;
    }

    .view-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border-radius: 999px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .btn-primary {
        background: var(--gold, #c9a962);
        color: var(--dark-bg, #0a0a0a);
        box-shadow: 0 10px 20px rgba(201, 169, 98, 0.2);
    }

    .btn-primary:hover {
        background: var(--gold-light, #d4b978);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: transparent;
        color: var(--text-white, #ffffff);
        border: 1px solid var(--dark-lighter, #2a2a2a);
    }

    .btn-secondary:hover {
        border-color: var(--gold, #c9a962);
        color: var(--gold, #c9a962);
    }

    .btn-danger {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.35);
    }

    .btn-danger:hover {
        background: rgba(239, 68, 68, 0.25);
        transform: translateY(-1px);
    }

    .service-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.85rem;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(255, 255, 255, 0.06);
        color: var(--text-gray, #a0a0a0);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .meta-pill.is-active {
        background: rgba(74, 222, 128, 0.2);
        color: #86efac;
        border-color: rgba(74, 222, 128, 0.4);
    }

    .meta-pill.is-inactive {
        background: rgba(239, 68, 68, 0.2);
        color: #fca5a5;
        border-color: rgba(239, 68, 68, 0.4);
    }

    .price-pill {
        background: var(--gold-soft, rgba(201, 169, 98, 0.2));
        color: var(--gold, #c9a962);
        border-color: rgba(201, 169, 98, 0.5);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .detail-item {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 1rem 1.1rem;
        border-radius: 12px;
    }

    .detail-item--full {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-size: 0.7rem;
        color: var(--text-muted, #7a7a7a);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 0.95rem;
        color: var(--text-white, #ffffff);
        font-weight: 500;
        line-height: 1.6;
        word-break: break-word;
    }

    .reserve-card {
        margin-top: 2rem;
        padding: 1.5rem;
        border-radius: 14px;
        border: 1px solid rgba(201, 169, 98, 0.3);
        background: linear-gradient(120deg, rgba(201, 169, 98, 0.12), rgba(10, 10, 10, 0.1));
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .reserve-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-white, #ffffff);
        margin-bottom: 0.25rem;
    }

    .reserve-text {
        font-size: 0.85rem;
        color: var(--text-gray, #a0a0a0);
    }

    .terms-modal {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .terms-modal.is-hidden {
        display: none;
    }

    .terms-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.68);
        backdrop-filter: blur(2px);
    }

    .terms-dialog {
        position: relative;
        width: min(540px, 92vw);
        background: var(--dark-card, #1a1a1a);
        border: 1px solid var(--dark-lighter, #2a2a2a);
        border-radius: 16px;
        padding: 1.75rem;
        z-index: 1;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
    }

    .terms-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: var(--text-white, #ffffff);
    }

    .terms-body {
        font-size: 0.875rem;
        color: var(--text-gray, #a0a0a0);
        line-height: 1.6;
    }

    .terms-check {
        display: flex;
        gap: 0.5rem;
        align-items: flex-start;
        margin-top: 1rem;
        color: var(--text-gray, #a0a0a0);
        font-size: 0.875rem;
    }

    .terms-check input {
        margin-top: 0.2rem;
    }

    .terms-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
        margin-top: 1.25rem;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .view-container {
            padding: 1.5rem 1rem;
        }

        .view-card {
            padding: 1.5rem;
        }

        .view-title {
            font-size: 1.35rem;
        }

        .view-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .view-actions {
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .reserve-card {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .view-container {
            padding: 1rem 0.75rem;
        }

        .view-card {
            padding: 1.25rem;
        }

        .view-title {
            font-size: 1.2rem;
        }

        .btn {
            padding: 0.55rem 1rem;
            font-size: 0.8125rem;
        }
    }
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <div>
                <h2 class="view-title"><?= h($xservServicio->nombre) ?></h2>
                <div class="view-subtitle">Detalle del servicio y condiciones generales.</div>
            </div>
            <div class="view-actions">
                <?php if ($isAdmin): ?>
                    <a href="<?= $this->Url->build(['action' => 'edit', $xservServicio->id]) ?>" class="btn btn-primary">Editar</a>
                    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                    <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $xservServicio->id], ['confirm' => '¿Está seguro?', 'class' => 'btn btn-danger']) ?>
                <?php else: ?>
                    <a href="/services" class="btn btn-secondary">Volver a Servicios</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="service-meta">
            <span class="meta-pill <?= h(strtolower($xservServicio->estado)) === 'activo' ? 'is-active' : 'is-inactive' ?>">Estado: <?= h($xservServicio->estado) ?></span>
            <span class="meta-pill price-pill">Precio base: $<?= $this->Number->format($xservServicio->precio_base) ?></span>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Nombre</div>
                <div class="detail-value"><?= h($xservServicio->nombre) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado</div>
                <div class="detail-value"><?= h($xservServicio->estado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Precio Base</div>
                <div class="detail-value">$<?= $this->Number->format($xservServicio->precio_base) ?></div>
            </div>
            <div class="detail-item detail-item--full">
                <div class="detail-label">Variantes</div>
                <div class="detail-value"><?= h($xservServicio->variantes) ?: '(Sin variantes)' ?></div>
            </div>
        </div>

        <div style="background: rgba(201, 169, 98, 0.1); border-left: 4px solid #c9a962; padding: 1rem; border-radius: 4px; margin-top: 1.5rem;">
            <p style="color: #c9a962; font-size: 0.875rem; margin: 0;">
                <strong>Nota:</strong> Las descripciones del servicio se gestionan automáticamente a través del sistema de idiomas (i18n). Las descripciones mostradas al público en español e inglés se actualizan desde la configuración centralizada del sistema.
            </p>
        </div>

        <?php if (!$isAdmin): ?>
        <div class="reserve-card">
            <div>
                <div class="reserve-title">Reserva este servicio</div>
                <div class="reserve-text">Acepta los terminos y condiciones para solicitar tu reserva.</div>
            </div>
            <button type="button" class="btn btn-primary" id="reserveBtn" data-service-id="<?= h($xservServicio->id) ?>">Reservar</button>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php if (!$isAdmin): ?>
<div class="terms-modal is-hidden" id="termsModal" aria-hidden="true">
    <div class="terms-backdrop" data-close="true"></div>
    <div class="terms-dialog" role="dialog" aria-modal="true" aria-labelledby="termsTitle">
        <div class="terms-title" id="termsTitle">Terminos y condiciones</div>
        <div class="terms-body">
            Al continuar, aceptas que la disponibilidad esta sujeta a confirmacion y que los tiempos pueden variar segun el servicio. Te notificaremos cualquier cambio.
        </div>
        <label class="terms-check">
            <input type="checkbox" id="termsAccept">
            <span>Acepto los terminos y condiciones del servicio.</span>
        </label>
        <div class="terms-actions">
            <button type="button" class="btn btn-secondary" id="cancelTermsBtn">Cancelar</button>
            <button type="button" class="btn btn-primary" id="confirmReserveBtn" disabled>Solicitar reserva</button>
        </div>
    </div>
</div>

<script>
(function() {
    const reserveBtn = document.getElementById('reserveBtn');
    const modal = document.getElementById('termsModal');
    const backdrop = modal ? modal.querySelector('.terms-backdrop') : null;
    const accept = document.getElementById('termsAccept');
    const confirmBtn = document.getElementById('confirmReserveBtn');
    const cancelBtn = document.getElementById('cancelTermsBtn');

    if (!reserveBtn || !modal || !accept || !confirmBtn || !cancelBtn || !backdrop) {
        return;
    }

    const openModal = () => {
        modal.classList.remove('is-hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.classList.add('is-hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        accept.checked = false;
        confirmBtn.disabled = true;
    };

    const isAuthenticated = async () => {
        try {
            const res = await fetch('/xserv-usuarios/me', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            if (!res.ok) {
                return false;
            }
            const data = await res.json();
            return Boolean(data && data.success);
        } catch (error) {
            return false;
        }
    };

    reserveBtn.addEventListener('click', openModal);
    backdrop.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    accept.addEventListener('change', () => {
        confirmBtn.disabled = !accept.checked;
    });

    confirmBtn.addEventListener('click', async () => {
        const serviceId = reserveBtn.dataset.serviceId;
        const target = serviceId ? `/newreservation?service_id=${serviceId}` : '/newreservation';
        if (!(await isAuthenticated())) {
            window.location.href = '/xserv-usuarios/login';
            return;
        }
        window.location.href = target;
    });
})();
</script>
<?php endif; ?>