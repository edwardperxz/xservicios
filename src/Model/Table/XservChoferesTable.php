<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservChoferes Model
 *
 * @property \App\Model\Table\XservUsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @method \App\Model\Entity\XservChofer newEmptyEntity()
 * @method \App\Model\Entity\XservChofer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservChofer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservChofer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservChofer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservChofer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservChofer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservChofer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservChofer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservChofer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservChofer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservChofer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservChofer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservChofer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservChofer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservChofer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservChofer> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservChoferesTable extends Table
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

        $this->setTable('xserv_choferes');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');
        $this->setEntityClass('App\\Model\\Entity\\XservChofer');
        
        $this->setDisplayField('usuario_id');
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'className' => 'XservUsuarios',
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
            ->integer('usuario_id')
            ->allowEmptyString('usuario_id');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 100)
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre');

        $validator
            ->scalar('identificacion')
            ->maxLength('identificacion', 50)
            ->requirePresence('identificacion', 'create')
            ->notEmptyString('identificacion')
            ->add('identificacion', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 20)
            ->requirePresence('telefono', 'create')
            ->notEmptyString('telefono');

        $validator
            ->scalar('correo')
            ->maxLength('correo', 100)
            ->allowEmptyString('correo');

        $validator
            ->scalar('estado')
            ->allowEmptyString('estado');

        $validator
            ->date('fecha_ingreso')
            ->requirePresence('fecha_ingreso', 'create')
            ->notEmptyDate('fecha_ingreso');

        $validator
            ->scalar('tipo_licencia')
            ->maxLength('tipo_licencia', 50)
            ->allowEmptyString('tipo_licencia');

        $validator
            ->scalar('disponibilidad')
            ->allowEmptyString('disponibilidad');

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
        $rules->add($rules->isUnique(['identificacion']), ['errorField' => 'identificacion']);
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'), ['errorField' => 'usuario_id']);

        return $rules;
    }
}
