<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservDestino $xservDestino
 * @var \Cake\Collection\CollectionInterface|string[] $ubicacions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservDestinos form content">
            <?= $this->Form->create($xservDestino) ?>
            <fieldset>
                <legend><?= __('Add Xserv Destino') ?></legend>
                <?php
                    echo $this->Form->control('ubicacion_id', ['options' => $ubicacions]);
                    echo $this->Form->control('descripcion_es');
                    echo $this->Form->control('descripcion_en');
                    echo $this->Form->control('es_popular');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
