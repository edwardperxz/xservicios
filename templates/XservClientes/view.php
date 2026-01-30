<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservCliente $xservCliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Cliente'), ['action' => 'edit', $xservCliente->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Cliente'), ['action' => 'delete', $xservCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservCliente->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Clientes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Cliente'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservClientes view content">
            <h3><?= h($xservCliente->nombre) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($xservCliente->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Identificacion Fiscal') ?></th>
                    <td><?= h($xservCliente->identificacion_fiscal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Correo') ?></th>
                    <td><?= h($xservCliente->correo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefono') ?></th>
                    <td><?= h($xservCliente->telefono) ?></td>
                </tr>
                <tr>
                    <th><?= __('Idioma Preferido') ?></th>
                    <td><?= h($xservCliente->idioma_preferido) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservCliente->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservCliente->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservCliente->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Direccion Facturacion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservCliente->direccion_facturacion)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>