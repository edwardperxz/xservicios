<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservConfiguraciones Model
 *
 * @method \App\Model\Entity\XservConfiguracione newEmptyEntity()
 * @method \App\Model\Entity\XservConfiguracione newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservConfiguracione> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservConfiguracione get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservConfiguracione findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservConfiguracione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservConfiguracione> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservConfiguracione|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservConfiguracione saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservConfiguracione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservConfiguracione>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservConfiguracione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservConfiguracione> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservConfiguracione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservConfiguracione>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservConfiguracione>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservConfiguracione> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservConfiguracionesTable extends Table
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

        $this->setTable('xserv_configuraciones');
        $this->setDisplayField('clave');
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
            ->scalar('clave')
            ->maxLength('clave', 100)
            ->requirePresence('clave', 'create')
            ->notEmptyString('clave')
            ->add('clave', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('valor')
            ->requirePresence('valor', 'create')
            ->notEmptyString('valor');

        $validator
            ->scalar('tipo_dato')
            ->allowEmptyString('tipo_dato');

        $validator
            ->scalar('grupo')
            ->requirePresence('grupo', 'create')
            ->notEmptyString('grupo');

        $validator
            ->scalar('descripcion_parametro')
            ->maxLength('descripcion_parametro', 255)
            ->allowEmptyString('descripcion_parametro');

        $validator
            ->boolean('editable_por_admin')
            ->allowEmptyString('editable_por_admin');

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
        $rules->add($rules->isUnique(['clave']), ['errorField' => 'clave']);

        return $rules;
    }
}
