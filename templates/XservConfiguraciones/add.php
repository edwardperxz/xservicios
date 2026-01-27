<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservConfiguracione $xservConfiguracione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Configuraciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservConfiguraciones form content">
            <?= $this->Form->create($xservConfiguracione) ?>
            <fieldset>
                <legend><?= __('Add Xserv Configuracione') ?></legend>
                <?php
                    echo $this->Form->control('clave');
                    echo $this->Form->control('valor');
                    echo $this->Form->control('tipo_dato');
                    echo $this->Form->control('grupo');
                    echo $this->Form->control('descripcion_parametro');
                    echo $this->Form->control('editable_por_admin');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
