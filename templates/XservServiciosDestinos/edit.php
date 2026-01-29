<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservServiciosDestino $xservServiciosDestino
 * @var string[]|\Cake\Collection\CollectionInterface $servicios
 * @var string[]|\Cake\Collection\CollectionInterface $destinos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservServiciosDestino->servicio_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservServiciosDestino->servicio_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Servicios Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservServiciosDestinos form content">
            <?= $this->Form->create($xservServiciosDestino) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Servicios Destino') ?></legend>
                <?php
                    echo $this->Form->control('orden_visita');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
