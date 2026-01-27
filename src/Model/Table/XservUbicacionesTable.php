<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservUbicaciones Model
 *
 * @method \App\Model\Entity\XservUbicacione newEmptyEntity()
 * @method \App\Model\Entity\XservUbicacione newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservUbicacione> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservUbicacione get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservUbicacione findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservUbicacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservUbicacione> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservUbicacione|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservUbicacione saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservUbicacione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUbicacione>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUbicacione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUbicacione> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUbicacione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUbicacione>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUbicacione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUbicacione> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservUbicacionesTable extends Table
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

        $this->setTable('xserv_ubicaciones');
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
            ->maxLength('nombre', 150)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('EN_PROVINCIAS')
            ->requirePresence('EN_PROVINCIAS', 'create')
            ->notEmptyString('EN_PROVINCIAS');

        $validator
            ->scalar('direccion_gps')
            ->maxLength('direccion_gps', 255)
            ->allowEmptyString('direccion_gps');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        return $validator;
    }
}
