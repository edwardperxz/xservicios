<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServicio $xservServicio
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Servicio'), ['action' => 'edit', $xservServicio->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Servicio'), ['action' => 'delete', $xservServicio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservServicio->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Servicios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Servicio'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservServicios view content">
            <h3><?= h($xservServicio->nombre) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($xservServicio->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($xservServicio->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservServicio->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Precio Base') ?></th>
                    <td><?= $this->Number->format($xservServicio->precio_base) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservServicio->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservServicio->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion Es') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservServicio->descripcion_es)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Descripcion En') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservServicio->descripcion_en)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Variantes') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservServicio->variantes)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>