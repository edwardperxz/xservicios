<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservReserva $xservReserva
 * @var \Cake\Collection\CollectionInterface|string[] $servicios
 * @var \Cake\Collection\CollectionInterface|string[] $rutas
 */
?>
<div class="row">
    <div class="column column-80">
        <section class="quote-section">
            <div class="quote-container">

                <h2 class="quote-title">Solicita tu Reserva</h2>
                <p class="quote-subtitle">Completa el formulario y espera nuestra aprobación</p>

                <?= $this->Form->create($xservReserva, ['class' => 'quote-form']) ?>

                <!-- Servicio -->
                <div class="form-group">
                    <?= $this->Form->control('servicio_id', [
                        'options' => $servicios,
                        'empty' => 'Selecciona el servicio',
                        'label' => 'Servicio',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <!-- Ruta -->
                <div class="form-group">
                    <?= $this->Form->control('ruta_id', [
                        'options' => $rutas,
                        'empty' => 'Selecciona la ruta',
                        'label' => 'Ruta',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <!-- Fecha y Hora -->
                <div class="form-group">
                    <?= $this->Form->control('fecha', [
                        'type' => 'date',
                        'label' => 'Fecha de la reserva',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('hora', [
                        'type' => 'time',
                        'label' => 'Hora de la reserva',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <!-- Cantidad de pasajeros -->
                <div class="form-group">
                    <?= $this->Form->control('pasajeros', [
                        'type' => 'number',
                        'label' => 'Número de pasajeros',
                        'class' => 'form-control',
                        'min' => 1
                    ]) ?>
                </div>

                <!-- Punto de Recogida y Destino -->
                <div class="form-group">
                    <?= $this->Form->control('punto_recogida', [
                        'label' => 'Punto de recogida',
                        'class' => 'form-control',
                        'placeholder' => 'Ej: Aeropuerto PTY'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $this->Form->control('punto_destino', [
                        'label' => 'Destino',
                        'class' => 'form-control',
                        'placeholder' => 'Ej: Hotel Central'
                    ]) ?>
                </div>

                <!-- Observaciones -->
                <div class="form-group">
                    <?= $this->Form->control('observaciones', [
                        'type' => 'textarea',
                        'label' => 'Observaciones',
                        'class' => 'form-control',
                        'placeholder' => 'Comentarios importantes...'
                    ]) ?>
                </div>

                <?= $this->Form->button(__('Solicitar Reserva'), ['class' => 'btn-primary']) ?>
                <?= $this->Form->end() ?>

            </div>
        </section>
    </div>
</div>
