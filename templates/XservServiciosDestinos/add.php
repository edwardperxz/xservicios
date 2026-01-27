<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServiciosDestino $xservServiciosDestino
 * @var \Cake\Collection\CollectionInterface|string[] $servicios
 * @var \Cake\Collection\CollectionInterface|string[] $destinos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Servicios Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservServiciosDestinos form content">
            <?= $this->Form->create($xservServiciosDestino) ?>
            <fieldset>
                <legend><?= __('Add Xserv Servicios Destino') ?></legend>
                <?php
                    echo $this->Form->control('orden_visita');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
