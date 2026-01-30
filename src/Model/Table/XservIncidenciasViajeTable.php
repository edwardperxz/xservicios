<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservIncidenciasViaje Model
 *
 * @property \App\Model\Table\XservEjecucionViajesTable&\Cake\ORM\Association\BelongsTo $Ejecucions
 *
 * @method \App\Model\Entity\XservIncidenciasViaje newEmptyEntity()
 * @method \App\Model\Entity\XservIncidenciasViaje newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservIncidenciasViaje> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservIncidenciasViaje get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservIncidenciasViaje findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservIncidenciasViaje patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservIncidenciasViaje> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservIncidenciasViaje|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservIncidenciasViaje saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservIncidenciasViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservIncidenciasViaje>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservIncidenciasViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservIncidenciasViaje> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservIncidenciasViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservIncidenciasViaje>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservIncidenciasViaje>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservIncidenciasViaje> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservIncidenciasViajeTable extends Table
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

        $this->setTable('xserv_incidencias_viaje');
        $this->setDisplayField('tipo_incidencia');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ejecucions', [
            'foreignKey' => 'ejecucion_id',
            'className' => 'XservEjecucionViajes',
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
            ->integer('ejecucion_id')
            ->notEmptyString('ejecucion_id');

        $validator
            ->scalar('tipo_incidencia')
            ->requirePresence('tipo_incidencia', 'create')
            ->notEmptyString('tipo_incidencia');

        $validator
            ->scalar('descripcion')
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion');

        $validator
            ->decimal('latitud_incidencia')
            ->allowEmptyString('latitud_incidencia');

        $validator
            ->decimal('longitud_incidencia')
            ->allowEmptyString('longitud_incidencia');

        $validator
            ->scalar('severidad')
            ->allowEmptyString('severidad');

        $validator
            ->boolean('resuelto')
            ->allowEmptyString('resuelto');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

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
        $rules->add($rules->existsIn(['ejecucion_id'], 'Ejecucions'), ['errorField' => 'ejecucion_id']);

        return $rules;
    }
}
