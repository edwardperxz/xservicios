<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUbicacione $xservUbicacione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservUbicacione->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservUbicacione->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Ubicaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservUbicaciones form content">
            <?= $this->Form->create($xservUbicacione) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Ubicacione') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('EN_PROVINCIAS');
                    echo $this->Form->control('direccion_gps');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
