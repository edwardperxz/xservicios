<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservRutas Model
 *
 * @property \App\Model\Table\XservUbicacionesTable&\Cake\ORM\Association\BelongsTo $Origens
 * @property \App\Model\Table\XservUbicacionesTable&\Cake\ORM\Association\BelongsTo $Destinos
 * @method \App\Model\Entity\XservRuta newEmptyEntity()
 * @method \App\Model\Entity\XservRuta newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservRuta> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservRuta get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservRuta findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservRuta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservRuta> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservRuta|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservRuta saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservRuta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservRuta>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservRuta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservRuta> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservRuta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservRuta>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservRuta>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservRuta> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservRutasTable extends Table
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

        $this->setTable('xserv_rutas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Origens', [
            'foreignKey' => 'origen_id',
            'className' => 'XservUbicaciones',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Destinos', [
            'foreignKey' => 'destino_id',
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
            ->integer('origen_id')
            ->notEmptyString('origen_id');

        $validator
            ->integer('destino_id')
            ->notEmptyString('destino_id');

        $validator
            ->decimal('precio_base')
            ->requirePresence('precio_base', 'create')
            ->notEmptyString('precio_base');

        $validator
            ->integer('tiempo_estimado_min')
            ->allowEmptyString('tiempo_estimado_min');

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
        $rules->add($rules->existsIn(['origen_id'], 'Origens'), ['errorField' => 'origen_id']);
        $rules->add($rules->existsIn(['destino_id'], 'Destinos'), ['errorField' => 'destino_id']);

        return $rules;
    }
}
