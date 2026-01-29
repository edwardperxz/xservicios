<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservUsuarios Model
 *
 * @method \App\Model\Entity\XservUsuario newEmptyEntity()
 * @method \App\Model\Entity\XservUsuario newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservUsuario> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservUsuario get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservUsuario findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservUsuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservUsuario> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservUsuario|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservUsuario saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservUsuario>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUsuario>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUsuario>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUsuario> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUsuario>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUsuario>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservUsuario>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservUsuario> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class XservUsuariosTable extends Table
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

        $this->setTable('xserv_usuarios');
        $this->setDisplayField('username');
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
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('rol')
            ->requirePresence('rol', 'create')
            ->notEmptyString('rol');

        $validator
            ->scalar('estado')
            ->notEmptyString('estado');

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
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }
}
