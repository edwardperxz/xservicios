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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservServicio->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservServicio->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Servicios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservServicios form content">
            <?= $this->Form->create($xservServicio) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Servicio') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('descripcion_es');
                    echo $this->Form->control('descripcion_en');
                    echo $this->Form->control('precio_base');
                    echo $this->Form->control('variantes');
                    echo $this->Form->control('estado');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
