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
        <!-- Quote Form Section -->
        <section class="quote-section">
            <div class="quote-container">

                <h2 class="quote-title">Solicita tu Reserva</h2>
                <p class="quote-subtitle">Completa el formulario y espera nuestra aprobación</p>

                <?= $this->Form->create($xservReserva, ['class' => 'quote-form']) ?>

                <div class="form-group">
                    <?= $this->Form->control('ruta_id', [
                        'options' => $rutas,
                        'empty' => true,
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Selecciona la ruta'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('fecha', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'date'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('hora', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'time'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('pasajeros', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Número de pasajeros'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('precio_pactado', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Precio pactado'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('punto_recogida', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Punto de recogida'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('punto_destino', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Destino'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('observaciones', [
                        'label' => false,
                        'class' => 'form-control',
                        'placeholder' => 'Observaciones'
                    ]) ?>
                </div>

                <?= $this->Form->button(__('Solicitar Reserva'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>

            </div>
        </section>
    </div>
</div>
