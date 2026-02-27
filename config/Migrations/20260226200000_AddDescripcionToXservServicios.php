<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

/**
 * Agregar campo descripcion para traducciones automáticas con i18n
 */
class AddDescripcionToXservServicios extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('xserv_servicios');
        
        $table->addColumn('descripcion', 'text', [
            'after' => 'nombre',
            'default' => null,
            'null' => true,
            'comment' => 'Descripción en español (traducible con i18n)'
        ]);
        
        $table->update();
    }
}
