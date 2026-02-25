<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * XservNotificaciones Model
 *
 * @property \App\Model\Table\XservUsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\XservClientesTable&\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\XservReservasTable&\Cake\ORM\Association\BelongsTo $Reservas
 * @method \App\Model\Entity\XservNotificacion newEmptyEntity()
 * @method \App\Model\Entity\XservNotificacion newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\XservNotificacion> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\XservNotificacion get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\XservNotificacion findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\XservNotificacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\XservNotificacion> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\XservNotificacion|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\XservNotificacion saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\XservNotificacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservNotificacion>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservNotificacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservNotificacion> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservNotificacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservNotificacion>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\XservNotificacion>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\XservNotificacion> deleteManyOrFail(iterable $entities, array $options = [])
 */
class XservNotificacionesTable extends Table
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

        $this->setTable('xserv_notificaciones');
        $this->setDisplayField('tipo_notificacion');
        $this->setPrimaryKey('id');
        $this->setEntityClass('App\\Model\\Entity\\XservNotificacion');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'className' => 'XservUsuarios',
        ]);
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
            'className' => 'XservClientes',
        ]);
        $this->belongsTo('Reservas', [
            'foreignKey' => 'reserva_id',
            'className' => 'XservReservas',
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
            ->integer('cliente_id')
            ->allowEmptyString('cliente_id');

        $validator
            ->integer('reserva_id')
            ->allowEmptyString('reserva_id');

        $validator
            ->scalar('tipo_notificacion')
            ->requirePresence('tipo_notificacion', 'create')
            ->notEmptyString('tipo_notificacion');

        $validator
            ->scalar('medio')
            ->requirePresence('medio', 'create')
            ->notEmptyString('medio');

        $validator
            ->scalar('destinatario')
            ->maxLength('destinatario', 100)
            ->requirePresence('destinatario', 'create')
            ->notEmptyString('destinatario');

        $validator
            ->scalar('contenido')
            ->requirePresence('contenido', 'create')
            ->notEmptyString('contenido');

        $validator
            ->scalar('estado_envio')
            ->allowEmptyString('estado_envio');

        $validator
            ->scalar('error_log')
            ->allowEmptyString('error_log');

        $validator
            ->dateTime('enviado_at')
            ->allowEmptyDateTime('enviado_at');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'), ['errorField' => 'usuario_id']);
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'), ['errorField' => 'cliente_id']);
        $rules->add($rules->existsIn(['reserva_id'], 'Reservas'), ['errorField' => 'reserva_id']);

        return $rules;
    }
}
