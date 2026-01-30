<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservRuta $xservRuta
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Ruta'), ['action' => 'edit', $xservRuta->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Ruta'), ['action' => 'delete', $xservRuta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservRuta->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Rutas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Ruta'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservRutas view content">
            <h3><?= h($xservRuta->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Origen') ?></th>
                    <td><?= $xservRuta->hasValue('origen') ? $this->Html->link($xservRuta->origen->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservRuta->origen->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Destino') ?></th>
                    <td><?= $xservRuta->hasValue('destino') ? $this->Html->link($xservRuta->destino->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservRuta->destino->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservRuta->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Precio Base') ?></th>
                    <td><?= $this->Number->format($xservRuta->precio_base) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tiempo Estimado Min') ?></th>
                    <td><?= $xservRuta->tiempo_estimado_min === null ? '' : $this->Number->format($xservRuta->tiempo_estimado_min) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>