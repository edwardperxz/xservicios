<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $xservUsuario
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $xservUsuario->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $xservUsuario->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Xserv Usuarios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservUsuarios form content">
            <?= $this->Form->create($xservUsuario) ?>
            <fieldset>
                <legend><?= __('Edit Xserv Usuario') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('rol');
                    echo $this->Form->control('estado');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
