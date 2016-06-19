<?php
namespace PaypalIpn\Model\Entity;

use Cake\ORM\Entity;

/**
 * PaypalItem Entity.
 *
 * @property string $id
 * @property string $instant_payment_notification_id
 * @property \PaypalIpn\Model\Entity\InstantPaymentNotification $instant_payment_notification
 * @property string $item_name
 * @property string $item_number
 * @property string $quantity
 * @property float $mc_gross
 * @property float $mc_shipping
 * @property float $mc_handling
 * @property float $tax
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class PaypalItem extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false,
	];
}
