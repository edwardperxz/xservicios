<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $xservUsuario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Usuario'), ['action' => 'edit', $xservUsuario->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Usuario'), ['action' => 'delete', $xservUsuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservUsuario->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Usuarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Usuario'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservUsuarios view content">
            <h3><?= h($xservUsuario->username) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($xservUsuario->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rol') ?></th>
                    <td><?= h($xservUsuario->rol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= h($xservUsuario->estado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservUsuario->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservUsuario->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservUsuario->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>