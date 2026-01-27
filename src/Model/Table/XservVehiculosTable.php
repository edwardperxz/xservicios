<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservVehiculos Model
 *
 * @method \App\Model\Entity\XservVehiculo newEmptyEntity()
 * @method \App\Model\Entity\XservVehiculo newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservVehiculo> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservVehiculo get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservVehiculo findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservVehiculo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservVehiculo> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservVehiculo|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservVehiculo saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservVehiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservVehiculo>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservVehiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservVehiculo> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservVehiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservVehiculo>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservVehiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservVehiculo> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservVehiculosTable extends Table
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

        $this->setTable('xserv_vehiculos');
        $this->setDisplayField('tipo');
        $this->setPrimaryKey('id');
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
            ->scalar('tipo')
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('nombre_unidad')
            ->maxLength('nombre_unidad', 50)
            ->allowEmptyString('nombre_unidad');

        $validator
            ->integer('capacidad_max')
            ->requirePresence('capacidad_max', 'create')
            ->notEmptyString('capacidad_max');

        $validator
            ->scalar('placa')
            ->maxLength('placa', 20)
            ->requirePresence('placa', 'create')
            ->notEmptyString('placa')
            ->add('placa', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('anio')
            ->allowEmptyString('anio');

        $validator
            ->integer('kilometraje_actual')
            ->allowEmptyString('kilometraje_actual');

        $validator
            ->scalar('estado_operativo')
            ->allowEmptyString('estado_operativo');

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
        $rules->add($rules->isUnique(['placa']), ['errorField' => 'placa']);

        return $rules;
    }
}
