<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservNotificacione $xservNotificacione
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Xserv Notificacione'), ['action' => 'edit', $xservNotificacione->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Xserv Notificacione'), ['action' => 'delete', $xservNotificacione->id], ['confirm' => __('Are you sure you want to delete # {0}?', $xservNotificacione->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Xserv Notificaciones'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Xserv Notificacione'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="xservNotificaciones view content">
            <h3><?= h($xservNotificacione->tipo_notificacion) ?></h3>
            <table>
                <tr>
                    <th><?= __('Usuario') ?></th>
                    <td><?= $xservNotificacione->hasValue('usuario') ? $this->Html->link($xservNotificacione->usuario->username, ['controller' => 'XservUsuarios', 'action' => 'view', $xservNotificacione->usuario->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Cliente') ?></th>
                    <td><?= $xservNotificacione->hasValue('cliente') ? $this->Html->link($xservNotificacione->cliente->nombre, ['controller' => 'XservClientes', 'action' => 'view', $xservNotificacione->cliente->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Reserva') ?></th>
                    <td><?= $xservNotificacione->hasValue('reserva') ? $this->Html->link($xservNotificacione->reserva->codigo_reserva, ['controller' => 'XservReservas', 'action' => 'view', $xservNotificacione->reserva->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo Notificacion') ?></th>
                    <td><?= h($xservNotificacione->tipo_notificacion) ?></td>
                </tr>
                <tr>
                    <th><?= __('Medio') ?></th>
                    <td><?= h($xservNotificacione->medio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Destinatario') ?></th>
                    <td><?= h($xservNotificacione->destinatario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado Envio') ?></th>
                    <td><?= h($xservNotificacione->estado_envio) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($xservNotificacione->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Enviado At') ?></th>
                    <td><?= h($xservNotificacione->enviado_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($xservNotificacione->created_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Contenido') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservNotificacione->contenido)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Error Log') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($xservNotificacione->error_log)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>