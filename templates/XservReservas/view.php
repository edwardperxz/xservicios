<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservReserva $xservReserva
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Reserva'), ['action' => 'edit', $xservReserva->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Reserva'), ['action' => 'delete', $xservReserva->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservReserva->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Reservas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Reserva'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservReservas view content">
            <h3><?= h($xservReserva->codigo_reserva) ?></h3>
            <table>
                <tr>
                    <th><?= __('Codigo Reserva') ?></th>
                    <td><?= h($xservReserva->codigo_reserva) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $xservReserva->hasValue('cliente') ? $this->Html->link($xservReserva->cliente->nombre, ['controller' => 'XservClientes', 'action' => 'view', $xservReserva->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Servicio') ?></th>
                    <td><?= $xservReserva->hasValue('servicio') ? $this->Html->link($xservReserva->servicio->nombre, ['controller' => 'XservServicios', 'action' => 'view', $xservReserva->servicio->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ruta') ?></th>
                    <td><?= $xservReserva->hasValue('ruta') ? $this->Html->link($xservReserva->ruta->id, ['controller' => 'XservRutas', 'action' => 'view', $xservReserva->ruta->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Punto Recogida') ?></th>
                    <td><?= h($xservReserva->punto_recogida) ?></td>
                </tr>
                <tr>
                    <th><?= __('Punto Destino') ?></th>
                    <td><?= h($xservReserva->punto_destino) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($xservReserva->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Pago') ?></th>
                    <td><?= h($xservReserva->estado_pago) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservReserva->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pasajeros') ?></th>
                    <td><?= $this->Number->format($xservReserva->pasajeros) ?></td>
                </tr>
                <tr>
                    <th><?= __('Precio Pactado') ?></th>
                    <td><?= $this->Number->format($xservReserva->precio_pactado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Itbms Pactado') ?></th>
                    <td><?= $xservReserva->itbms_pactado === null ? '' : $this->Number->format($xservReserva->itbms_pactado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha') ?></th>
                    <td><?= h($xservReserva->fecha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora') ?></th>
                    <td><?= h($xservReserva->hora) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservReserva->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservReserva->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observaciones') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservReserva->observaciones)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>