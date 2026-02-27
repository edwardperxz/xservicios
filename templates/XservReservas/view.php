<?php
$this->assign('header-title', 'Detalle de Reserva');
?>

<style>
:root { 
    --gold: #c9a962; 
    --gold-light: #d4b978; 
    --gold-dark: #b08d4a;
    --dark-bg: #0a0a0a; 
    --dark-card: #1a1a1a; 
    --dark-lighter: #2a2a2a; 
    --text-white: #ffffff; 
    --text-gray: #a0a0a0; 
    --red: #ef4444; 
    --blue: #3b82f6; 
    --green: #4ade80; 
}

.view-container { 
    width: 100%; 
    padding: 2rem; 
    display: flex; 
    justify-content: center;
    background: linear-gradient(135deg, rgba(10, 10, 10, 0.95) 0%, rgba(26, 26, 26, 0.95) 100%);
    min-height: calc(100vh - 80px);
}

.view-card { 
    background: linear-gradient(145deg, #1a1a1a 0%, #222222 100%);
    border-radius: 16px; 
    padding: 2.5rem; 
    border: 1px solid rgba(201, 169, 98, 0.2);
    width: 100%; 
    max-width: 1100px;
    box-shadow: 
        0 10px 40px rgba(0, 0, 0, 0.5),
        0 0 30px rgba(201, 169, 98, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.view-card:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 15px 50px rgba(0, 0, 0, 0.6),
        0 0 40px rgba(201, 169, 98, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.05);
}

.view-header { 
    margin-bottom: 2.5rem; 
    padding-bottom: 1.5rem; 
    border-bottom: 2px solid;
    border-image: linear-gradient(90deg, var(--gold, #c9a962), transparent) 1;
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    gap: 1rem; 
}

.view-title { 
    font-size: 1.75rem; 
    font-weight: 700; 
    color: var(--text-white, #ffffff);
    letter-spacing: -0.5px;
    text-shadow: 0 2px 10px rgba(201, 169, 98, 0.3);
}

.view-actions { 
    display: flex; 
    gap: 0.75rem; 
    flex-wrap: wrap; 
}

.btn { 
    padding: 0.75rem 1.5rem; 
    border-radius: 10px; 
    font-weight: 600; 
    text-decoration: none; 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    border: none; 
    cursor: pointer; 
    font-size: 0.875rem; 
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.btn-primary { 
    background: linear-gradient(135deg, var(--gold, #c9a962) 0%, var(--gold-light, #d4b978) 100%);
    color: var(--dark-bg, #0a0a0a);
}

.btn-primary:hover { 
    background: linear-gradient(135deg, var(--gold-light, #d4b978) 0%, var(--gold, #c9a962) 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201, 169, 98, 0.4);
}

.btn-secondary { 
    background: var(--dark-lighter, #2a2a2a); 
    color: var(--text-white, #ffffff); 
    border: 1px solid rgba(160, 160, 160, 0.3);
}

.btn-secondary:hover { 
    border-color: var(--gold, #c9a962);
    background: rgba(201, 169, 98, 0.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(201, 169, 98, 0.2);
}

.btn-danger { 
    background: linear-gradient(135deg, var(--red, #ef4444) 0%, #dc2626 100%);
    color: var(--text-white, #ffffff);
}

.btn-danger:hover { 
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
}

.detail-grid { 
    display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
    gap: 1.25rem; 
}

.detail-item { 
    background: linear-gradient(135deg, rgba(42, 42, 42, 0.8) 0%, rgba(35, 35, 35, 0.8) 100%);
    padding: 1.25rem; 
    border-radius: 12px;
    border: 1px solid rgba(201, 169, 98, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.detail-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--gold, #c9a962), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.detail-item:hover {
    transform: translateY(-2px);
    border-color: rgba(201, 169, 98, 0.3);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, rgba(42, 42, 42, 0.95) 0%, rgba(35, 35, 35, 0.95) 100%);
}

.detail-item:hover::before {
    opacity: 1;
}

.detail-label { 
    font-size: 0.75rem; 
    color: var(--gold, #c9a962);
    text-transform: uppercase; 
    letter-spacing: 1px; 
    margin-bottom: 0.75rem;
    font-weight: 600;
}

.detail-value { 
    font-size: 1.05rem; 
    color: var(--text-white, #ffffff); 
    font-weight: 500; 
    word-break: break-word;
    line-height: 1.5;
}

.detail-value a { 
    color: var(--gold-light, #d4b978);
    text-decoration: none;
    transition: color 0.2s ease;
}

.detail-value a:hover { 
    color: var(--gold, #c9a962);
    text-decoration: underline;
}

@media (max-width: 768px) { 
    .view-container { 
        padding: 1rem;
        min-height: auto;
    }
    
    .view-card { 
        padding: 1.5rem;
        border-radius: 12px;
    }
    
    .view-title { 
        font-size: 1.35rem; 
    }
    
    .view-header { 
        flex-direction: column; 
        align-items: flex-start;
        margin-bottom: 2rem;
    }
    
    .view-actions { 
        width: 100%; 
    }
    
    .btn { 
        width: 100%;
        padding: 0.875rem 1.25rem;
    }
    
    .detail-grid { 
        grid-template-columns: 1fr; 
        gap: 1rem; 
    }
}

@media (max-width: 480px) { 
    .view-container { 
        padding: 0.75rem; 
    }
    
    .view-card { 
        padding: 1.25rem;
        border-radius: 10px;
    }
    
    .view-title { 
        font-size: 1.2rem; 
    }
    
    .btn { 
        padding: 0.75rem 1rem; 
        font-size: 0.8125rem; 
    }
    
    .detail-item {
        padding: 1rem;
    }
}
</style>

<div class="view-container">
    <div class="view-card">
        <div class="view-header">
            <h2 class="view-title">Reserva: <?= h($xservReserva->codigo_reserva) ?></h2>
            <div class="view-actions">
                <a href="<?= $this->Url->build(['action' => 'edit', $xservReserva->id]) ?>" class="btn btn-primary">Editar</a>
                <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Volver al Listado</a>
                <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $xservReserva->id], ['confirm' => '¿Está seguro?', 'class' => 'btn btn-danger']) ?>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Código Reserva</div>
                <div class="detail-value"><?= h($xservReserva->codigo_reserva) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Cliente</div>
                <div class="detail-value"><?= $xservReserva->hasValue('cliente') ? $this->Html->link(($xservReserva->cliente?->usuario?->nombre ?? $xservReserva->cliente?->usuario?->username ?? 'Sin nombre'), ['controller' => 'XservClientes', 'action' => 'view', $xservReserva->cliente->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Servicio</div>
                <div class="detail-value"><?= $xservReserva->hasValue('servicio') ? $this->Html->link($xservReserva->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservReserva->servicio->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Ruta</div>
                <div class="detail-value"><?= $xservReserva->hasValue('ruta') ? $this->Html->link('Ruta #' . $xservReserva->ruta->id, ['controller' => 'XservRutas', 'action' => 'view', $xservReserva->ruta->id]) : '<span style="color: #6b7280;">No asignado</span>' ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Fecha</div>
                <div class="detail-value"><?= h($xservReserva->fecha) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Hora</div>
                <div class="detail-value"><?= h($xservReserva->hora) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Punto Recogida</div>
                <div class="detail-value"><?= h($xservReserva->punto_recogida) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Punto Destino</div>
                <div class="detail-value"><?= h($xservReserva->punto_destino) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Pasajeros</div>
                <div class="detail-value"><?= $this->Number->format($xservReserva->pasajeros) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Precio Pactado</div>
                <div class="detail-value">$<?= $this->Number->format($xservReserva->precio_pactado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">ITBMS (7%)</div>
                <div class="detail-value">$<?= $xservReserva->itbms_pactado === null ? '0.00' : $this->Number->format($xservReserva->itbms_pactado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Total</div>
                <div class="detail-value" style="font-weight: 600; font-size: 1.1em; color: #2196f3;">$<?= $this->Number->format($xservReserva->precio_pactado + ($xservReserva->itbms_pactado ?? 0)) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado</div>
                <div class="detail-value"><?= h($xservReserva->estado) ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Estado Pago</div>
                <div class="detail-value"><?= h($xservReserva->estado_pago) ?></div>
            </div>
            <div class="detail-item" style="grid-column: 1 / -1;">
                <div class="detail-label">Observaciones</div>
                <div class="detail-value"><?= h($xservReserva->observaciones) ?></div>
            </div>
        </div>
    </div>
</div>