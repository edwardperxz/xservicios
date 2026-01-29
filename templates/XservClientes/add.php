<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservCliente $xservCliente
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Clientes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservClientes form content">
            <?= $this->Form->create($xservCliente) ?>
            <fieldset>
                <legend><?= __('Add Xserv Cliente') ?></legend>
                <?php
                    echo $this->Form->control('nombre');
                    echo $this->Form->control('identificacion_fiscal');
                    echo $this->Form->control('correo');
                    echo $this->Form->control('telefono');
                    echo $this->Form->control('direccion_facturacion');
                    echo $this->Form->control('idioma_preferido');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
