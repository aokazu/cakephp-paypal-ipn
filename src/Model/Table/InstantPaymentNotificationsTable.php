<?php
namespace PaypalIpn\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use PaypalIpn\Model\Entity\InstantPaymentNotification;

/**
 * InstantPaymentNotifications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentTxns
 * @property \Cake\ORM\Association\HasMany $PaypalItems
 */
class InstantPaymentNotificationsTable extends Table
{

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('instant_payment_notifications');
		$this->displayField('id');
		$this->primaryKey('id');

		$this->addBehavior('Timestamp');

		$this->hasMany('PaypalItems', [
			'foreignKey' => 'instant_payment_notification_id',
			'className' => 'PaypalIpn.PaypalItems'
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator)
	{
		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules)
	{
		return $rules;
	}
}
