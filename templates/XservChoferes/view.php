<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofere $xservChofere
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Chofere'), ['action' => 'edit', $xservChofere->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Chofere'), ['action' => 'delete', $xservChofere->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservChofere->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Choferes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Chofere'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservChoferes view content">
            <h3><?= h($xservChofere->nombre) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= $xservChofere->hasValue('usuario') ? $this->Html->link($xservChofere->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservChofere->usuario->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($xservChofere->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Identificacion') ?></th>
                    <td><?= h($xservChofere->identificacion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefono') ?></th>
                    <td><?= h($xservChofere->telefono) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correo') ?></th>
                    <td><?= h($xservChofere->correo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($xservChofere->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo Licencia') ?></th>
                    <td><?= h($xservChofere->tipo_licencia) ?></td>
                </tr>
                <tr>
                    <th><?= __('Disponibilidad') ?></th>
                    <td><?= h($xservChofere->disponibilidad) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservChofere->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Ingreso') ?></th>
                    <td><?= h($xservChofere->fecha_ingreso) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservChofere->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservChofere->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>