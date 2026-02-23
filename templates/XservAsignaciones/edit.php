<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservAsignacione $xservAsignacione
 * @var string[]|\Cake\Collection\CollectionInterface $reservas
 * @var string[]|\Cake\Collection\CollectionInterface $chofers
 * @var string[]|\Cake\Collection\CollectionInterface $vehiculos
 * @var string[]|\Cake\Collection\CollectionInterface $asignadoPors
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservAsignacione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservAsignacione->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Asignaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservAsignaciones form content">
            <?= $this->Form->create($xservAsignacione) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Asignacione') ?></legend>
                <?php
                    echo $this->Form->control('reserva_id', ['options' => $reservas]);
                    echo $this->Form->control('chofer_id', ['options' => $chofers]);
                    echo $this->Form->control('vehiculo_id', ['options' => $vehiculos]);
                    echo $this->Form->control('asignado_por_id', ['options' => $asignadoPors]);
                    echo $this->Form->control('fecha_inicio_pactada');
                    echo $this->Form->control('fecha_fin_pactada');
                    echo $this->Form->control('estado_asignacion');
                    echo $this->Form->control('observaciones_chofer');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
