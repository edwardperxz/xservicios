<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\XservUsuario $user
 * @var int $totalReservas
 * @var int $totalChoferes
 * @var int $totalVehiculos
 * @var int $totalEvaluaciones
 * @var int $totalIncidencias
 */
$this->assign('header-title', 'Exportar PDF');
?>

<style>
    .export-card {
        background: var(--dark-card);
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--dark-lighter);
        margin-bottom: 1.5rem;
    }

    .export-title {
        font-size: 1.25rem;
        color: var(--text-white);
        margin-bottom: 0.75rem;
    }

    .export-desc {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .export-table {
        width: 100%;
        border-collapse: collapse;
    }

    .export-table th,
    .export-table td {
        text-align: left;
        padding: 0.75rem 0.5rem;
        border-bottom: 1px solid var(--dark-lighter);
    }

    .export-table th {
        color: var(--text-gray);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .export-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-print {
        padding: 0.6rem 1rem;
        background: var(--gold);
        color: var(--dark-bg);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-back {
        padding: 0.6rem 1rem;
        background: var(--dark-lighter);
        color: var(--text-white);
        border: 1px solid var(--dark-lighter);
        border-radius: 6px;
        text-decoration: none;
    }

    @media print {
        .sidebar,
        .admin-header,
        .export-actions {
            display: none;
        }

        body {
            background: #ffffff;
            color: #000000;
        }

        .export-card {
            border: none;
            box-shadow: none;
        }
    }
</style>

<div class="export-card">
    <h2 class="export-title">Resumen de Reportes</h2>
    <p class="export-desc">Usa el boton de imprimir para guardar este resumen como PDF.</p>

    <table class="export-table">
        <thead>
            <tr>
                <th>Reporte</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Reservas</td>
                <td><?= $totalReservas ?? 0 ?></td>
            </tr>
            <tr>
                <td>Choferes</td>
                <td><?= $totalChoferes ?? 0 ?></td>
            </tr>
            <tr>
                <td>Vehiculos</td>
                <td><?= $totalVehiculos ?? 0 ?></td>
            </tr>
            <tr>
                <td>Evaluaciones</td>
                <td><?= $totalEvaluaciones ?? 0 ?></td>
            </tr>
            <tr>
                <td>Incidencias</td>
                <td><?= $totalIncidencias ?? 0 ?></td>
            </tr>
        </tbody>
    </table>

    <div class="export-actions">
        <button class="btn-print" onclick="window.print()">Imprimir / Guardar PDF</button>
        <a class="btn-back" href="<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'reportes']) ?>">Volver a reportes</a>
    </div>
</div>
