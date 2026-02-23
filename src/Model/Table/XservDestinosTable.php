<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservDestinos Model
 *
 * @property \App\Model\Table\XservUbicacionesTable&\Cake\ORM\Association\BelongsTo $Ubicacions
 * @method \App\Model\Entity\XservDestino newEmptyEntity()
 * @method \App\Model\Entity\XservDestino newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservDestino> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservDestino get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservDestino findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservDestino patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservDestino> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservDestino|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservDestino saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservDestino>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservDestino> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservDestino>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservDestino> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservDestinosTable extends Table
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

        $this->setTable('xserv_destinos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ubicacions', [
            'foreignKey' => 'ubicacion_id',
            'className' => 'XservUbicaciones',
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
            ->integer('ubicacion_id')
            ->notEmptyString('ubicacion_id');

        $validator
            ->scalar('descripcion_es')
            ->requirePresence('descripcion_es', 'create')
            ->notEmptyString('descripcion_es');

        $validator
            ->scalar('descripcion_en')
            ->requirePresence('descripcion_en', 'create')
            ->notEmptyString('descripcion_en');

        $validator
            ->boolean('es_popular')
            ->allowEmptyString('es_popular');

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
        $rules->add($rules->existsIn(['ubicacion_id'], 'Ubicacions'), ['errorField' => 'ubicacion_id']);

        return $rules;
    }
}
