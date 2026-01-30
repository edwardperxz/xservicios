<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservReserva $xservReserva
 * @var \Cake\Collection\CollectionInterface|string[] $clientes
 * @var \Cake\Collection\CollectionInterface|string[] $servicios
 * @var \Cake\Collection\CollectionInterface|string[] $rutas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Xserv Reservas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservReservas form content">
            <?= $this->Form->create($xservReserva) ?>
            <fieldset>
                <legend><?= __('Add Xserv Reserva') ?></legend>
                <?php
                    echo $this->Form->control('codigo_reserva');
                    echo $this->Form->control('cliente_id', ['options' => $clientes]);
                    echo $this->Form->control('servicio_id', ['options' => $servicios]);
                    echo $this->Form->control('ruta_id', ['options' => $rutas, 'empty' => true]);
                    echo $this->Form->control('fecha');
                    echo $this->Form->control('hora');
                    echo $this->Form->control('pasajeros');
                    echo $this->Form->control('precio_pactado');
                    echo $this->Form->control('itbms_pactado');
                    echo $this->Form->control('punto_recogida');
                    echo $this->Form->control('punto_destino');
                    echo $this->Form->control('observaciones');
                    echo $this->Form->control('estado');
                    echo $this->Form->control('estado_pago');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
