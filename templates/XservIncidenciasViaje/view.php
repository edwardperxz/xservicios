<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservIncidenciasViaje $xservIncidenciasViaje
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Incidencias Viaje'), ['action' => 'edit', $xservIncidenciasViaje->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Incidencias Viaje'), ['action' => 'delete', $xservIncidenciasViaje->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservIncidenciasViaje->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Incidencias Viaje'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Incidencias Viaje'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservIncidenciasViaje view content">
            <h3><?= h($xservIncidenciasViaje->tipo_incidencia) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ejecucion') ?></th>
                    <td><?= $xservIncidenciasViaje->hasValue('ejecucion') ? $this->Html->link($xservIncidenciasViaje->ejecucion->id, ['controller' => 'XservEjecucionViajes', 'action' => 'view', $xservIncidenciasViaje->ejecucion->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo Incidencia') ?></th>
                    <td><?= h($xservIncidenciasViaje->tipo_incidencia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Severidad') ?></th>
                    <td><?= h($xservIncidenciasViaje->severidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservIncidenciasViaje->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitud Incidencia') ?></th>
                    <td><?= $xservIncidenciasViaje->latitud_incidencia === null ? '' : $this->Number->format($xservIncidenciasViaje->latitud_incidencia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Longitud Incidencia') ?></th>
                    <td><?= $xservIncidenciasViaje->longitud_incidencia === null ? '' : $this->Number->format($xservIncidenciasViaje->longitud_incidencia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservIncidenciasViaje->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Resuelto') ?></th>
                    <td><?= $xservIncidenciasViaje->resuelto ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservIncidenciasViaje->descripcion)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>