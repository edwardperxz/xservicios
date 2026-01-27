<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservServiciosDestinos Model
 *
 * @property \App\Model\Table\XservServiciosTable&\Cake\ORM\Association\BelongsTo $Servicios
 * @property \App\Model\Table\XservDestinosTable&\Cake\ORM\Association\BelongsTo $Destinos
 *
 * @method \App\Model\Entity\XservServiciosDestino newEmptyEntity()
 * @method \App\Model\Entity\XservServiciosDestino newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservServiciosDestino> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservServiciosDestino get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservServiciosDestino findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservServiciosDestino patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservServiciosDestino> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservServiciosDestino|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservServiciosDestino saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservServiciosDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServiciosDestino>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServiciosDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServiciosDestino> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServiciosDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServiciosDestino>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservServiciosDestino>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservServiciosDestino> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservServiciosDestinosTable extends Table
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

        $this->setTable('xserv_servicios_destinos');
        $this->setDisplayField(['servicio_id', 'destino_id']);
        $this->setPrimaryKey(['servicio_id', 'destino_id']);

        $this->belongsTo('Servicios', [
            'foreignKey' => 'servicio_id',
            'className' => 'XservServicios',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Destinos', [
            'foreignKey' => 'destino_id',
            'className' => 'XservDestinos',
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
            ->integer('orden_visita')
            ->allowEmptyString('orden_visita');

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
        $rules->add($rules->existsIn(['servicio_id'], 'Servicios'), ['errorField' => 'servicio_id']);
        $rules->add($rules->existsIn(['destino_id'], 'Destinos'), ['errorField' => 'destino_id']);

        return $rules;
    }
}
