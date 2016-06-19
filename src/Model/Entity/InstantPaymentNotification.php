<?php
namespace PaypalIpn\Model\Entity;

use Cake\ORM\Entity;

/**
 * InstantPaymentNotification Entity.
 *
 * @property string $id
 * @property string $notify_version
 * @property string $verify_sign
 * @property int $test_ipn
 * @property string $address_city
 * @property string $address_country
 * @property string $address_country_code
 * @property string $address_name
 * @property string $address_state
 * @property string $address_status
 * @property string $address_street
 * @property string $address_zip
 * @property string $first_name
 * @property string $last_name
 * @property string $payer_business_name
 * @property string $payer_email
 * @property string $payer_id
 * @property string $payer
 * @property string $payer_status
 * @property string $contact_phone
 * @property string $residence_country
 * @property string $business
 * @property string $item_name
 * @property string $item_number
 * @property string $quantity
 * @property string $item_name1
 * @property string $item_number1
 * @property string $quantity1
 * @property string $receiver_email
 * @property string $receiver_id
 * @property string $receiver
 * @property string $custom
 * @property string $invoice
 * @property string $memo
 * @property string $option_name_1
 * @property string $option_name_2
 * @property string $option_selection1
 * @property string $option_selection2
 * @property float $tax
 * @property string $auth_id
 * @property string $auth
 * @property string $auth_exp
 * @property int $auth_amount
 * @property string $auth_status
 * @property int $num_cart_items
 * @property string $parent_txn_id
 * @property string $parent_txn
 * @property string $payment_date
 * @property string $payment_status
 * @property string $payment_type
 * @property string $pending_reason
 * @property string $reason_code
 * @property int $remaining_settle
 * @property string $shipping_method
 * @property float $shipping
 * @property string $transaction_entity
 * @property string $txn_id
 * @property string $txn
 * @property string $txn_type
 * @property float $exchange_rate
 * @property string $mc_currency
 * @property float $mc_fee
 * @property float $mc_gross
 * @property float $mc_handling
 * @property float $mc_shipping
 * @property float $payment_fee
 * @property float $payment_gross
 * @property float $settle_amount
 * @property string $settle_currency
 * @property string $auction_buyer_id
 * @property string $auction_buyer
 * @property string $auction_closing_date
 * @property int $auction_multi_item
 * @property string $for_auction
 * @property string $subscr_date
 * @property string $subscr_effective
 * @property string $period1
 * @property string $period2
 * @property string $period3
 * @property float $amount1
 * @property float $amount2
 * @property float $amount3
 * @property float $mc_amount1
 * @property float $mc_amount2
 * @property float $mc_amount3
 * @property string $recurring
 * @property string $reattempt
 * @property string $retry_at
 * @property int $recur_times
 * @property string $username
 * @property string $password
 * @property string $subscr_id
 * @property string $subscr
 * @property string $case_id
 * @property string $case
 * @property string $case_type
 * @property string $case_creation_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \PaypalIpn\Model\Entity\PaypalItem[] $paypal_items
 */
class InstantPaymentNotification extends Entity
{

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 * @var array
	 */
	protected $_accessible = [
		'*' => true,
		'id' => false,
		'created' => false,
		'modified' => false
	];

	/**
	 * Fields that are excluded from JSON an array versions of the entity.
	 *
	 * @var array
	 */
	protected $_hidden = [
	];
}
