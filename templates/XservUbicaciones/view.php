<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUbicacione $xservUbicacione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Ubicacione'), ['action' => 'edit', $xservUbicacione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Ubicacione'), ['action' => 'delete', $xservUbicacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservUbicacione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Ubicaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Ubicacione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservUbicaciones view content">
            <h3><?= h($xservUbicacione->nombre) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($xservUbicacione->nombre) ?></td>
                </tr>
                <tr>
                    <th><?= __('EN PROVINCIAS') ?></th>
                    <td><?= h($xservUbicacione->EN_PROVINCIAS) ?></td>
                </tr>
                <tr>
                    <th><?= __('Direccion Gps') ?></th>
                    <td><?= h($xservUbicacione->direccion_gps) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservUbicacione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservUbicacione->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>