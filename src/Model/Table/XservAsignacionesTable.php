<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservAsignaciones Model
 *
 * @property \App\Model\Table\XservReservasTable&\Cake\ORM\Association\BelongsTo $Reservas
 * @property \App\Model\Table\XservChoferesTable&\Cake\ORM\Association\BelongsTo $Chofers
 * @property \App\Model\Table\XservVehiculosTable&\Cake\ORM\Association\BelongsTo $Vehiculos
 * @property \App\Model\Table\XservUsuariosTable&\Cake\ORM\Association\BelongsTo $AsignadoPors
 * @method \App\Model\Entity\XservAsignacion newEmptyEntity()
 * @method \App\Model\Entity\XservAsignacion newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservAsignacion> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservAsignacion get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservAsignacion findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservAsignacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservAsignacion> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservAsignacion|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservAsignacion saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservAsignacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservAsignacion>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservAsignacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservAsignacion> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservAsignacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservAsignacion>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservAsignacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservAsignacion> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservAsignacionesTable extends Table
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

        $this->setTable('xserv_asignaciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->setEntityClass('App\\Model\\Entity\\XservAsignacion');

        $this->belongsTo('Reservas', [
            'foreignKey' => 'reserva_id',
            'className' => 'XservReservas',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Chofers', [
            'foreignKey' => 'chofer_id',
            'className' => 'XservChoferes',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Vehiculos', [
            'foreignKey' => 'vehiculo_id',
            'className' => 'XservVehiculos',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AsignadoPors', [
            'foreignKey' => 'asignado_por_id',
            'className' => 'XservUsuarios',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Choferes', [
        'foreignKey' => 'chofer_id',
        'className' => 'XservChoferes',
        'joinType' => 'INNER',
        ]);
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
            ->integer('reserva_id')
            ->notEmptyString('reserva_id');

        $validator
            ->integer('chofer_id')
            ->notEmptyString('chofer_id');

        $validator
            ->integer('vehiculo_id')
            ->notEmptyString('vehiculo_id');

        $validator
            ->integer('asignado_por_id')
            ->notEmptyString('asignado_por_id');

        $validator
            ->dateTime('fecha_inicio_pactada')
            ->requirePresence('fecha_inicio_pactada', 'create')
            ->notEmptyDateTime('fecha_inicio_pactada');

        $validator
            ->dateTime('fecha_fin_pactada')
            ->requirePresence('fecha_fin_pactada', 'create')
            ->notEmptyDateTime('fecha_fin_pactada');

        $validator
            ->scalar('estado_asignacion')
            ->allowEmptyString('estado_asignacion');

        $validator
            ->scalar('observaciones_chofer')
            ->allowEmptyString('observaciones_chofer');

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
        $rules->add($rules->existsIn(['reserva_id'], 'Reservas'), ['errorField' => 'reserva_id']);
        $rules->add($rules->existsIn(['chofer_id'], 'Chofers'), ['errorField' => 'chofer_id']);
        $rules->add($rules->existsIn(['vehiculo_id'], 'Vehiculos'), ['errorField' => 'vehiculo_id']);
        $rules->add($rules->existsIn(['asignado_por_id'], 'AsignadoPors'), ['errorField' => 'asignado_por_id']);

        return $rules;
    }
}
