<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservReservas Model
 *
 * @property \App\Model\Table\XservClientesTable&\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\XservServiciosTable&\Cake\ORM\Association\BelongsTo $Servicios
 * @property \App\Model\Table\XservRutasTable&\Cake\ORM\Association\BelongsTo $Rutas
 * @method \App\Model\Entity\XservReserva newEmptyEntity()
 * @method \App\Model\Entity\XservReserva newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservReserva> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservReserva get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservReserva findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservReserva patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservReserva> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservReserva|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservReserva saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservReserva>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservReserva>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservReserva>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservReserva> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservReserva>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservReserva>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservReserva>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservReserva> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservReservasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('xserv_reservas');
        $this->setDisplayField('codigo_reserva');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'className' => 'XservClientes',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Servicios', [
            'foreignKey' => 'servicio_id',
            'className' => 'XservServicios',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('XservServicios', [
            'foreignKey' => 'servicio_id',
            'className' => 'XservServicios',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('XservClientes', [
            'foreignKey' => 'cliente_id',
            'className' => 'XservClientes',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Rutas', [
            'foreignKey' => 'ruta_id',
            'className' => 'XservRutas',
        ]);
        
        // Generar código automático antes de guardar
        $this->getEventManager()->on('Model.beforeSave', function ($event, $entity, $options) {
            if ($entity->isNew() && empty($entity->codigo_reserva)) {
                $entity->codigo_reserva = $this->generateUniqueCode();
            }
        });
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('codigo_reserva')
            ->maxLength('codigo_reserva', 20)
            ->allowEmptyString('codigo_reserva')
            ->add('codigo_reserva', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('cliente_id')
            ->notEmptyString('cliente_id');

        $validator
            ->integer('servicio_id')
            ->notEmptyString('servicio_id');

        $validator
            ->integer('ruta_id')
            ->allowEmptyString('ruta_id');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->time('hora')
            ->requirePresence('hora', 'create')
            ->notEmptyTime('hora');

        $validator
            ->integer('pasajeros')
            ->requirePresence('pasajeros', 'create')
            ->notEmptyString('pasajeros');

        $validator
            ->decimal('precio_pactado')
            ->requirePresence('precio_pactado', 'create')
            ->notEmptyString('precio_pactado');

        $validator
            ->decimal('itbms_pactado')
            ->allowEmptyString('itbms_pactado');

        $validator
            ->scalar('punto_recogida')
            ->maxLength('punto_recogida', 255)
            ->requirePresence('punto_recogida', 'create')
            ->notEmptyString('punto_recogida');

        $validator
            ->scalar('punto_destino')
            ->maxLength('punto_destino', 255)
            ->requirePresence('punto_destino', 'create')
            ->notEmptyString('punto_destino');

        $validator
            ->scalar('observaciones')
            ->allowEmptyString('observaciones');

        $validator
            ->scalar('estado')
            ->allowEmptyString('estado');

        $validator
            ->scalar('estado_pago')
            ->allowEmptyString('estado_pago');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['codigo_reserva']), ['errorField' => 'codigo_reserva']);
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'), ['errorField' => 'cliente_id']);
        $rules->add($rules->existsIn(['servicio_id'], 'Servicios'), ['errorField' => 'servicio_id']);
        $rules->add($rules->existsIn(['ruta_id'], 'Rutas'), ['errorField' => 'ruta_id']);

        return $rules;
    }

    /**
     * Genera un código de reserva único y aleatorio
     * Formato: RSV-YYYY-XXXXXX
     * @return string
     */
    protected function generateUniqueCode(): string
    {
        $year = date('Y');
        $maxAttempts = 10;
        
        for ($i = 0; $i < $maxAttempts; $i++) {
            // Generar código aleatorio de 6 caracteres alfanuméricos
            $random = strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6));
            $code = "RSV-{$year}-{$random}";
            
            // Verificar si ya existe
            if (!$this->exists(['codigo_reserva' => $code])) {
                return $code;
            }
        }
        
        // En caso extremadamente raro de colisión después de 10 intentos, agregar timestamp
        $timestamp = substr(time(), -4);
        return "RSV-{$year}-{$timestamp}" . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2));
    }
}
