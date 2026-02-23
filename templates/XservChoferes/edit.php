<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservChofere $xservChofere
 * @var string[]|\Cake\Collection\CollectionInterface $usuarios
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservChofere->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservChofere->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Choferes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservChoferes form content">
            <?= $this->Form->create($xservChofere) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Chofere') ?></legend>
                <?php
                    echo $this->Form->control('usuario_id', ['options' => $usuarios, 'empty' => true]);
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('identificacion');
                    echo $this->Form->control('telefono');
                    echo $this->Form->control('correo');
                    echo $this->Form->control('estado');
                    echo $this->Form->control('fecha_ingreso');
                    echo $this->Form->control('tipo_licencia');
                    echo $this->Form->control('disponibilidad');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
