<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\XservUsuario> $xservUsuarios
 */
?>
<div class="xservUsuarios index content">
    <?= $this->Html->link(__('New Xserv Usuario'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Xserv Usuarios') ?></h3>
    <div class="filters-panel">
        <?= $this->Form->create(null, ['type' => 'get', 'class' => 'filters-form']) ?>

        <!-- Rol: tipo Twitch -->
        <div class="roles-filter">
            <?php foreach (['admin' => 'Admin', 'operador' => 'Operador', 'chofer' => 'Chofer'] as $rolKey => $rolLabel): ?>
                <?= $this->Form->button(
                    $rolLabel,
                    [
                        'type' => 'submit',
                        'name' => 'rol',
                        'value' => $rolKey,
                        'class' => 'role-button' . (($filters['rol'] ?? '') === $rolKey ? ' active' : '')
                    ]
                ) ?>
            <?php endforeach; ?>
            <!-- Botón para mostrar todos -->
            <?= $this->Form->button('Todos', ['type'=>'submit', 'name'=>'rol','value'=>'','class'=>'role-button'.((empty($filters['rol']))?' active':'')]) ?>
        </div>

        <!-- Estado: botones rápido -->
        <div class="status-filter">
            <?php foreach (['activo' => 'Activo', 'inactivo' => 'Inactivo'] as $estadoKey => $estadoLabel): ?>
                <?= $this->Form->button(
                    $estadoLabel,
                    [
                        'type'=>'submit',
                        'name'=>'estado',
                        'value'=>$estadoKey,
                        'class'=>'status-button' . (($filters['estado'] ?? '') === $estadoKey ? ' active' : '')
                    ]
                ) ?>
            <?php endforeach; ?>
            <?= $this->Form->button('Todos', ['type'=>'submit','name'=>'estado','value'=>'','class'=>'status-button'.((empty($filters['estado']))?' active':'')]) ?>
        </div>

        <!-- Buscador de username -->
        <div class="search-filter">
            <?= $this->Form->control('username', ['label'=>false, 'placeholder'=>'Buscar usuario', 'value'=>$filters['username'] ?? null]) ?>
            <?= $this->Form->button('Buscar') ?>
        </div>

        <?= $this->Form->end() ?>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('rol') ?></th>
                    <th><?= $this->Paginator->sort('estado') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xservUsuarios as $xservUsuario): ?>
                <tr>
                    <td><?= $this->Number->format($xservUsuario->id) ?></td>
                    <td><?= h($xservUsuario->username) ?></td>
                    <td><?= h($xservUsuario->rol) ?></td>
                    <td><?= h($xservUsuario->estado) ?></td>
                    <td><?= h($xservUsuario->created_at) ?></td>
                    <td><?= h($xservUsuario->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $xservUsuario->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $xservUsuario->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $xservUsuario->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $xservUsuario->id),
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