<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservDestino $xservDestino
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Destino'), ['action' => 'edit', $xservDestino->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Destino'), ['action' => 'delete', $xservDestino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservDestino->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Destino'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservDestinos view content">
            <h3><?= h($xservDestino->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Ubicacion') ?></th>
                    <td><?= $xservDestino->hasValue('ubicacion') ? $this->Html->link($xservDestino->ubicacion->nombre, ['controller' => 'XservUbicaciones', 'action' => 'view', $xservDestino->ubicacion->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservDestino->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservDestino->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Es Popular') ?></th>
                    <td><?= $xservDestino->es_popular ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion Es') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservDestino->descripcion_es)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Descripcion En') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservDestino->descripcion_en)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>