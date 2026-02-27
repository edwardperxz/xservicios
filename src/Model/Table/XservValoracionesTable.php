<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservValoraciones Model
 *
 * @property \App\Model\Table\XservReservasTable&\Cake\ORM\Association\BelongsTo $XservReservas
 * @method \App\Model\Entity\XservValoracion newEmptyEntity()
 * @method \App\Model\Entity\XservValoracion newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservValoracion> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservValoracion get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservValoracion findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservValoracion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservValoracion> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservValoracion|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservValoracion saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservValoracion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservValoracion>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservValoracion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservValoracion> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservValoracion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservValoracion>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservValoracion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservValoracion> deleteManyOrFail(iterable $entities, array $options = [])
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class XservValoracionesTable extends Table
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

        $this->setTable('xserv_valoraciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->setEntityClass('App\\Model\\Entity\\XservValoracion');

        $this->addBehavior('Timestamp');

        $this->belongsTo('XservReservas', [
            'foreignKey' => 'reserva_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('reserva_id')
            ->requirePresence('reserva_id', 'create')
            ->notEmptyString('reserva_id');

        $validator
            ->integer('calificacion')
            ->requirePresence('calificacion', 'create')
            ->range('calificacion', [1, 5], 'La calificación debe estar entre 1 y 5');

        $validator
            ->integer('puntuacion_limpieza')
            ->range('puntuacion_limpieza', [1, 5])
            ->allowEmptyString('puntuacion_limpieza');

        $validator
            ->integer('puntuacion_puntualidad')
            ->range('puntuacion_puntualidad', [1, 5])
            ->allowEmptyString('puntuacion_puntualidad');

        $validator
            ->scalar('comentarios')
            ->allowEmptyString('comentarios');

        $validator
            ->scalar('estado_moderacion')
            ->allowEmptyString('estado_moderacion');

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
        $rules->add($rules->existsIn(['reserva_id'], 'XservReservas'), ['errorField' => 'reserva_id']);

        return $rules;
    }
}
