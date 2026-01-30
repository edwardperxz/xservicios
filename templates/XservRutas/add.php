<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservRuta $xservRuta
 * @var \Cake\Collection\CollectionInterface|string[] $origens
 * @var \Cake\Collection\CollectionInterface|string[] $destinos
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Rutas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservRutas form content">
            <?= $this->Form->create($xservRuta) ?>
            <fieldset>
                <legend><?= __('Add Xserv Ruta') ?></legend>
                <?php
                    echo $this->Form->control('origen_id', ['options' => $origens]);
                    echo $this->Form->control('destino_id', ['options' => $destinos]);
                    echo $this->Form->control('precio_base');
                    echo $this->Form->control('tiempo_estimado_min');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
