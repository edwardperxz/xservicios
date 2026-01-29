<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservDestino $xservDestino
 * @var string[]|\Cake\Collection\CollectionInterface $ubicacions
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservDestino->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservDestino->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Destinos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservDestinos form content">
            <?= $this->Form->create($xservDestino) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Destino') ?></legend>
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
