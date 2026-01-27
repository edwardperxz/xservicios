<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservConfiguracione $xservConfiguracione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Configuracione'), ['action' => 'edit', $xservConfiguracione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Configuracione'), ['action' => 'delete', $xservConfiguracione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservConfiguracione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Configuraciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Configuracione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservConfiguraciones view content">
            <h3><?= h($xservConfiguracione->clave) ?></h3>
            <table>
                <tr>
                    <th><?= __('Clave') ?></th>
                    <td><?= h($xservConfiguracione->clave) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo Dato') ?></th>
                    <td><?= h($xservConfiguracione->tipo_dato) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grupo') ?></th>
                    <td><?= h($xservConfiguracione->grupo) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripcion Parametro') ?></th>
                    <td><?= h($xservConfiguracione->descripcion_parametro) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservConfiguracione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($xservConfiguracione->updated_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Editable Por Admin') ?></th>
                    <td><?= $xservConfiguracione->editable_por_admin ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Valor') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservConfiguracione->valor)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>