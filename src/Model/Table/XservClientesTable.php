<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservClientes Model
 *
 * @method \App\Model\Entity\XservCliente newEmptyEntity()
 * @method \App\Model\Entity\XservCliente newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservCliente> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservCliente get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservCliente findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservCliente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservCliente> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservCliente|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservCliente saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservCliente>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservCliente>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservCliente>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservCliente> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservCliente>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservCliente>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservCliente>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservCliente> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservClientesTable extends Table
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

        $this->setTable('xserv_clientes');
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
            ->scalar('identificacion_fiscal')
            ->maxLength('identificacion_fiscal', 50)
            ->allowEmptyString('identificacion_fiscal');

        $validator
            ->scalar('correo')
            ->maxLength('correo', 100)
            ->requirePresence('correo', 'create')
            ->notEmptyString('correo');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 20)
            ->requirePresence('telefono', 'create')
            ->notEmptyString('telefono');

        $validator
            ->scalar('direccion_facturacion')
            ->allowEmptyString('direccion_facturacion');

        $validator
            ->scalar('idioma_preferido')
            ->allowEmptyString('idioma_preferido');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
