<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservEjecucionViaje $xservEjecucionViaje
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Ejecucion Viaje'), ['action' => 'edit', $xservEjecucionViaje->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Ejecucion Viaje'), ['action' => 'delete', $xservEjecucionViaje->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservEjecucionViaje->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Ejecucion Viajes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Ejecucion Viaje'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservEjecucionViajes view content">
            <h3><?= h($xservEjecucionViaje->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Asignacion') ?></th>
                    <td><?= $xservEjecucionViaje->hasValue('asignacion') ? $this->Html->link($xservEjecucionViaje->asignacion->id, ['controller' => 'XservAsignaciones', 'action' => 'view', $xservEjecucionViaje->asignacion->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Ejecucion') ?></th>
                    <td><?= h($xservEjecucionViaje->estado_ejecucion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservEjecucionViaje->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Km Inicio') ?></th>
                    <td><?= $xservEjecucionViaje->km_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->km_inicio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Km Fin') ?></th>
                    <td><?= $xservEjecucionViaje->km_fin === null ? '' : $this->Number->format($xservEjecucionViaje->km_fin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lat Inicio') ?></th>
                    <td><?= $xservEjecucionViaje->lat_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->lat_inicio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lng Inicio') ?></th>
                    <td><?= $xservEjecucionViaje->lng_inicio === null ? '' : $this->Number->format($xservEjecucionViaje->lng_inicio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lat Fin') ?></th>
                    <td><?= $xservEjecucionViaje->lat_fin === null ? '' : $this->Number->format($xservEjecucionViaje->lat_fin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lng Fin') ?></th>
                    <td><?= $xservEjecucionViaje->lng_fin === null ? '' : $this->Number->format($xservEjecucionViaje->lng_fin) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Inicio Real') ?></th>
                    <td><?= h($xservEjecucionViaje->hora_inicio_real) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hora Fin Real') ?></th>
                    <td><?= h($xservEjecucionViaje->hora_fin_real) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservEjecucionViaje->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservEjecucionViaje->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Observaciones Finales') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservEjecucionViaje->observaciones_finales)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>