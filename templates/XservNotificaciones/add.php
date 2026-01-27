<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservNotificacione $xservNotificacione
 * @var \Cake\Collection\CollectionInterface|string[] $usuarios
 * @var \Cake\Collection\CollectionInterface|string[] $clientes
 * @var \Cake\Collection\CollectionInterface|string[] $reservas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Notificaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservNotificaciones form content">
            <?= $this->Form->create($xservNotificacione) ?>
            <fieldset>
                <legend><?= __('Add Xserv Notificacione') ?></legend>
                <?php
                    echo $this->Form->control('usuario_id', ['options' => $usuarios, 'empty' => true]);
                    echo $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]);
                    echo $this->Form->control('reserva_id', ['options' => $reservas, 'empty' => true]);
                    echo $this->Form->control('tipo_notificacion');
                    echo $this->Form->control('medio');
                    echo $this->Form->control('destinatario');
                    echo $this->Form->control('contenido');
                    echo $this->Form->control('estado_envio');
                    echo $this->Form->control('error_log');
                    echo $this->Form->control('enviado_at');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
