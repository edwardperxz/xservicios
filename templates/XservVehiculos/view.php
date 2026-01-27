<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservVehiculo $xservVehiculo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Vehiculo'), ['action' => 'edit', $xservVehiculo->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Vehiculo'), ['action' => 'delete', $xservVehiculo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservVehiculo->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Vehiculos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Vehiculo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservVehiculos view content">
            <h3><?= h($xservVehiculo->tipo) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tipo') ?></th>
                    <td><?= h($xservVehiculo->tipo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre Unidad') ?></th>
                    <td><?= h($xservVehiculo->nombre_unidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Placa') ?></th>
                    <td><?= h($xservVehiculo->placa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Operativo') ?></th>
                    <td><?= h($xservVehiculo->estado_operativo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservVehiculo->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Capacidad Max') ?></th>
                    <td><?= $this->Number->format($xservVehiculo->capacidad_max) ?></td>
                </tr>
                <tr>
                    <th><?= __('Anio') ?></th>
                    <td><?= $xservVehiculo->anio === null ? '' : $this->Number->format($xservVehiculo->anio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kilometraje Actual') ?></th>
                    <td><?= $xservVehiculo->kilometraje_actual === null ? '' : $this->Number->format($xservVehiculo->kilometraje_actual) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservVehiculo->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservVehiculo->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>