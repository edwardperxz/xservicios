<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservVehiculo $xservVehiculo
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservVehiculo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservVehiculo->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Vehiculos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservVehiculos form content">
            <?= $this->Form->create($xservVehiculo) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Vehiculo') ?></legend>
                <?php
                    echo $this->Form->control('tipo');
                    echo $this->Form->control('nombre_unidad');
                    echo $this->Form->control('capacidad_max');
                    echo $this->Form->control('placa');
                    echo $this->Form->control('anio');
                    echo $this->Form->control('kilometraje_actual');
                    echo $this->Form->control('estado_operativo');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
