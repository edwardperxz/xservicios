<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservEjecucionViaje $xservEjecucionViaje
 * @var string[]|\Cake\Collection\CollectionInterface $asignacions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservEjecucionViaje->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservEjecucionViaje->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Ejecucion Viajes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservEjecucionViajes form content">
            <?= $this->Form->create($xservEjecucionViaje) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Ejecucion Viaje') ?></legend>
                <?php
                    echo $this->Form->control('asignacion_id', ['options' => $asignacions]);
                    echo $this->Form->control('hora_inicio_real', ['empty' => true]);
                    echo $this->Form->control('hora_fin_real', ['empty' => true]);
                    echo $this->Form->control('km_inicio');
                    echo $this->Form->control('km_fin');
                    echo $this->Form->control('lat_inicio');
                    echo $this->Form->control('lng_inicio');
                    echo $this->Form->control('lat_fin');
                    echo $this->Form->control('lng_fin');
                    echo $this->Form->control('estado_ejecucion');
                    echo $this->Form->control('observaciones_finales');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
