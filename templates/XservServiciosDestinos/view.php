<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServiciosDestino $xservServiciosDestino
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Servicios Destino'), ['action' => 'edit', $xservServiciosDestino->servicio_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Servicios Destino'), ['action' => 'delete', $xservServiciosDestino->servicio_id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservServiciosDestino->servicio_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Servicios Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Servicios Destino'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservServiciosDestinos view content">
            <h3><?= h($xservServiciosDestino->Array) ?></h3>
            <table>
                <tr>
                    <th><?= __('Servicio') ?></th>
                    <td><?= $xservServiciosDestino->hasValue('servicio') ? $this->Html->link($xservServiciosDestino->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservServiciosDestino->servicio->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Destino') ?></th>
                    <td><?= $xservServiciosDestino->hasValue('destino') ? $this->Html->link($xservServiciosDestino->destino->id, ['controller' => 'XservDestinos', 'action' => 'view', $xservServiciosDestino->destino->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Orden Visita') ?></th>
                    <td><?= $xservServiciosDestino->orden_visita === null ? '' : $this->Number->format($xservServiciosDestino->orden_visita) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>