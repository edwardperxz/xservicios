<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservIncidenciasViaje $xservIncidenciasViaje
 * @var string[]|\Cake\Collection\CollectionInterface $ejecucions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservIncidenciasViaje->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservIncidenciasViaje->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Incidencias Viaje'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservIncidenciasViaje form content">
            <?= $this->Form->create($xservIncidenciasViaje) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Incidencias Viaje') ?></legend>
                <?php
                    echo $this->Form->control('ejecucion_id', ['options' => $ejecucions]);
                    echo $this->Form->control('tipo_incidencia');
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('latitud_incidencia');
                    echo $this->Form->control('longitud_incidencia');
                    echo $this->Form->control('severidad');
                    echo $this->Form->control('resuelto');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
