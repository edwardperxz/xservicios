<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservAsignacione $xservAsignacione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Asignacione'), ['action' => 'edit', $xservAsignacione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Asignacione'), ['action' => 'delete', $xservAsignacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservAsignacione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Asignaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Asignacione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservAsignaciones view content">
            <h3><?= h($xservAsignacione->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Reserva') ?></th>
                    <td><?= $xservAsignacione->hasValue('reserva') ? $this->Html->link($xservAsignacione->reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservAsignacione->reserva->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Chofer') ?></th>
                    <td><?= $xservAsignacione->hasValue('chofer') ? $this->Html->link($xservAsignacione->chofer->nombre, ['controller' => 'XservChoferes', 'action' => 'view', $xservAsignacione->chofer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Vehiculo') ?></th>
                    <td><?= $xservAsignacione->hasValue('vehiculo') ? $this->Html->link($xservAsignacione->vehiculo->tipo, ['controller' => 'XservVehiculos', 'action' => 'view', $xservAsignacione->vehiculo->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Asignado Por') ?></th>
                    <td><?= $xservAsignacione->hasValue('asignado_por') ? $this->Html->link($xservAsignacione->asignado_por->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservAsignacione->asignado_por->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Asignacion') ?></th>
                    <td><?= h($xservAsignacione->estado_asignacion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservAsignacione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Inicio Pactada') ?></th>
                    <td><?= h($xservAsignacione->fecha_inicio_pactada) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Fin Pactada') ?></th>
                    <td><?= h($xservAsignacione->fecha_fin_pactada) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservAsignacione->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservAsignacione->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observaciones Chofer') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservAsignacione->observaciones_chofer)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>