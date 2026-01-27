<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservServicios Model
 *
 * @method \App\Model\Entity\XservServicio newEmptyEntity()
 * @method \App\Model\Entity\XservServicio newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservServicio> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservServicio get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservServicio findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservServicio patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservServicio> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservServicio|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservServicio saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservServicio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServicio>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServicio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServicio> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServicio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServicio>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServicio>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServicio> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservServiciosTable extends Table
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

        $this->setTable('xserv_servicios');
        $this->setDisplayField('nombre');
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
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('descripcion_es')
            ->requirePresence('descripcion_es', 'create')
            ->notEmptyString('descripcion_es');

        $validator
            ->scalar('descripcion_en')
            ->requirePresence('descripcion_en', 'create')
            ->notEmptyString('descripcion_en');

        $validator
            ->decimal('precio_base')
            ->requirePresence('precio_base', 'create')
            ->notEmptyString('precio_base');

        $validator
            ->scalar('variantes')
            ->allowEmptyString('variantes');

        $validator
            ->scalar('estado')
            ->allowEmptyString('estado');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
