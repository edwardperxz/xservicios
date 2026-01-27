<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservConfiguracione> $xservConfiguraciones
 */
?>
<div class="xservConfiguraciones index content">
    <?= $this->Html->link(__('New Xserv Configuracione'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Configuraciones') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('clave') ?></th>
                    <th><?= $this->Paginator->sort('tipo_dato') ?></th>
                    <th><?= $this->Paginator->sort('grupo') ?></th>
                    <th><?= $this->Paginator->sort('descripcion_parametro') ?></th>
                    <th><?= $this->Paginator->sort('editable_por_admin') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservConfiguraciones as $xservConfiguracione): ?>
                <tr>
                    <td><?= $this->Number->format($xservConfiguracione->id) ?></td>
                    <td><?= h($xservConfiguracione->clave) ?></td>
                    <td><?= h($xservConfiguracione->tipo_dato) ?></td>
                    <td><?= h($xservConfiguracione->grupo) ?></td>
                    <td><?= h($xservConfiguracione->descripcion_parametro) ?></td>
                    <td><?= h($xservConfiguracione->editable_por_admin) ?></td>
                    <td><?= h($xservConfiguracione->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservConfiguracione->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservConfiguracione->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservConfiguracione->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservConfiguracione->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>