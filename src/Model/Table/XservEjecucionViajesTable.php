<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservEjecucionViajes Model
 *
 * @property \App\Model\Table\XservAsignacionesTable&\Cake\ORM\Association\BelongsTo $Asignacions
 * @method \App\Model\Entity\XservEjecucionViaje newEmptyEntity()
 * @method \App\Model\Entity\XservEjecucionViaje newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservEjecucionViaje> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservEjecucionViaje get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservEjecucionViaje findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservEjecucionViaje patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservEjecucionViaje> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservEjecucionViaje|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservEjecucionViaje saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservEjecucionViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservEjecucionViaje>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservEjecucionViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservEjecucionViaje> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservEjecucionViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservEjecucionViaje>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservEjecucionViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservEjecucionViaje> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservEjecucionViajesTable extends Table
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

        $this->setTable('xserv_ejecucion_viajes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Asignacions', [
            'foreignKey' => 'asignacion_id',
            'className' => 'XservAsignaciones',
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
            ->integer('asignacion_id')
            ->notEmptyString('asignacion_id');

        $validator
            ->dateTime('hora_inicio_real')
            ->allowEmptyDateTime('hora_inicio_real');

        $validator
            ->dateTime('hora_fin_real')
            ->allowEmptyDateTime('hora_fin_real');

        $validator
            ->integer('km_inicio')
            ->allowEmptyString('km_inicio');

        $validator
            ->integer('km_fin')
            ->allowEmptyString('km_fin');

        $validator
            ->decimal('lat_inicio')
            ->allowEmptyString('lat_inicio');

        $validator
            ->decimal('lng_inicio')
            ->allowEmptyString('lng_inicio');

        $validator
            ->decimal('lat_fin')
            ->allowEmptyString('lat_fin');

        $validator
            ->decimal('lng_fin')
            ->allowEmptyString('lng_fin');

        $validator
            ->scalar('estado_ejecucion')
            ->allowEmptyString('estado_ejecucion');

        $validator
            ->scalar('observaciones_finales')
            ->allowEmptyString('observaciones_finales');

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
        $rules->add($rules->existsIn(['asignacion_id'], 'Asignacions'), ['errorField' => 'asignacion_id']);

        return $rules;
    }
}
