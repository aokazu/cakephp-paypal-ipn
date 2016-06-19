<?php
namespace PaypalIpn\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InstantPaymentNotificationsFixture
 *
 */
class InstantPaymentNotificationsFixture extends TestFixture
{

	/**
	 * Fields
	 *
	 * @var array
	 */
	// @codingStandardsIgnoreStart
	public $fields = [
		'id' => [
			'type' => 'string',
			'length' => 36,
			'null' => false,
			'default' => null,
			'comment' => '',
			'precision' => null,
			'fixed' => null
		],
		'notify_version' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'IPN Version Number',
			'precision' => null,
			'fixed' => null
		],
		'verify_sign' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Encrypted string used to verify the authenticityof the tansaction',
			'precision' => null,
			'fixed' => null
		],
		'test_ipn' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null,
			'autoIncrement' => null
		],
		'address_city' => [
			'type' => 'string',
			'length' => 40,
			'null' => true,
			'default' => null,
			'comment' => 'City of customers address',
			'precision' => null,
			'fixed' => null
		],
		'address_country' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'Country of customers address',
			'precision' => null,
			'fixed' => null
		],
		'address_country_code' => [
			'type' => 'string',
			'length' => 2,
			'null' => true,
			'default' => null,
			'comment' => 'Two character ISO 3166 country code',
			'precision' => null,
			'fixed' => null
		],
		'address_name' => [
			'type' => 'string',
			'length' => 128,
			'null' => true,
			'default' => null,
			'comment' => 'Name used with address (included when customer provides a Gift address)',
			'precision' => null,
			'fixed' => null
		],
		'address_state' => [
			'type' => 'string',
			'length' => 40,
			'null' => true,
			'default' => null,
			'comment' => 'State of customer address',
			'precision' => null,
			'fixed' => null
		],
		'address_status' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'confirmed/unconfirmed',
			'precision' => null,
			'fixed' => null
		],
		'address_street' => [
			'type' => 'string',
			'length' => 200,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s street address',
			'precision' => null,
			'fixed' => null
		],
		'address_zip' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'Zip code of customer\'s address',
			'precision' => null,
			'fixed' => null
		],
		'first_name' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s first name',
			'precision' => null,
			'fixed' => null
		],
		'last_name' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s last name',
			'precision' => null,
			'fixed' => null
		],
		'payer_business_name' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s company name, if customer represents a business',
			'precision' => null,
			'fixed' => null
		],
		'payer_email' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s primary email address. Use this email to provide any credits',
			'precision' => null,
			'fixed' => null
		],
		'payer_id' => [
			'type' => 'string',
			'length' => 13,
			'null' => true,
			'default' => null,
			'comment' => 'Unique customer ID.',
			'precision' => null,
			'fixed' => null
		],
		'payer_status' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'verified/unverified',
			'precision' => null,
			'fixed' => null
		],
		'contact_phone' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'Customer\'s telephone number.',
			'precision' => null,
			'fixed' => null
		],
		'residence_country' => [
			'type' => 'string',
			'length' => 2,
			'null' => true,
			'default' => null,
			'comment' => 'Two-Character ISO 3166 country code',
			'precision' => null,
			'fixed' => null
		],
		'business' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
			'precision' => null,
			'fixed' => null
		],
		'item_name' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
			'precision' => null,
			'fixed' => null
		],
		'item_number' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
			'precision' => null,
			'fixed' => null
		],
		'quantity' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
			'precision' => null,
			'fixed' => null
		],
		'item_name1' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null,
			'fixed' => null
		],
		'item_number1' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null,
			'fixed' => null
		],
		'quantity1' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null,
			'fixed' => null
		],
		'receiver_email' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
			'precision' => null,
			'fixed' => null
		],
		'receiver_id' => [
			'type' => 'string',
			'length' => 13,
			'null' => true,
			'default' => null,
			'comment' => 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
			'precision' => null,
			'fixed' => null
		],
		'custom' => [
			'type' => 'string',
			'length' => 255,
			'null' => true,
			'default' => null,
			'comment' => 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
			'precision' => null,
			'fixed' => null
		],
		'invoice' => [
			'type' => 'string',
			'length' => 127,
			'null' => true,
			'default' => null,
			'comment' => 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
			'precision' => null,
			'fixed' => null
		],
		'memo' => [
			'type' => 'string',
			'length' => 255,
			'null' => true,
			'default' => null,
			'comment' => 'Memo as entered by your customer in PayPal Website Payments note field.',
			'precision' => null,
			'fixed' => null
		],
		'option_name_1' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'Option name 1 as requested by you',
			'precision' => null,
			'fixed' => null
		],
		'option_name_2' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'Option 2 name as requested by you',
			'precision' => null,
			'fixed' => null
		],
		'option_selection1' => [
			'type' => 'string',
			'length' => 200,
			'null' => true,
			'default' => null,
			'comment' => 'Option 1 choice as entered by your customer',
			'precision' => null,
			'fixed' => null
		],
		'option_selection2' => [
			'type' => 'string',
			'length' => 200,
			'null' => true,
			'default' => null,
			'comment' => 'Option 2 choice as entered by your customer',
			'precision' => null,
			'fixed' => null
		],
		'tax' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of tax charged on payment'
		],
		'auth_id' => [
			'type' => 'string',
			'length' => 19,
			'null' => true,
			'default' => null,
			'comment' => 'Authorization identification number',
			'precision' => null,
			'fixed' => null
		],
		'auth_exp' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
			'precision' => null,
			'fixed' => null
		],
		'auth_amount' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Authorization amount',
			'precision' => null,
			'autoIncrement' => null
		],
		'auth_status' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'Status of authorization',
			'precision' => null,
			'fixed' => null
		],
		'num_cart_items' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'If this is a PayPal shopping cart transaction, number of items in the cart',
			'precision' => null,
			'autoIncrement' => null
		],
		'parent_txn_id' => [
			'type' => 'string',
			'length' => 19,
			'null' => true,
			'default' => null,
			'comment' => 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
			'precision' => null,
			'fixed' => null
		],
		'payment_date' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
			'precision' => null,
			'fixed' => null
		],
		'payment_status' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'Payment status of the payment',
			'precision' => null,
			'fixed' => null
		],
		'payment_type' => [
			'type' => 'string',
			'length' => 10,
			'null' => true,
			'default' => null,
			'comment' => 'echeck/instant',
			'precision' => null,
			'fixed' => null
		],
		'pending_reason' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'This variable is only set if payment_status=pending',
			'precision' => null,
			'fixed' => null
		],
		'reason_code' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'This variable is only set if payment_status=reversed',
			'precision' => null,
			'fixed' => null
		],
		'remaining_settle' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Remaining amount that can be captured with Authorization and Capture',
			'precision' => null,
			'autoIncrement' => null
		],
		'shipping_method' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
			'precision' => null,
			'fixed' => null
		],
		'shipping' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places'
		],
		'transaction_entity' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'Authorization and capture transaction entity',
			'precision' => null,
			'fixed' => null
		],
		'txn_id' => [
			'type' => 'string',
			'length' => 19,
			'null' => true,
			'default' => null,
			'comment' => 'A unique transaction ID generated by PayPal',
			'precision' => null,
			'fixed' => null
		],
		'txn_type' => [
			'type' => 'string',
			'length' => 20,
			'null' => true,
			'default' => null,
			'comment' => 'cart/express_checkout/send-money/virtual-terminal/web-accept',
			'precision' => null,
			'fixed' => null
		],
		'exchange_rate' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Exchange rate used if a currency conversion occured'
		],
		'mc_currency' => [
			'type' => 'string',
			'length' => 3,
			'null' => true,
			'default' => null,
			'comment' => 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
			'precision' => null,
			'fixed' => null
		],
		'mc_fee' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p'
		],
		'mc_gross' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Full amount of the customer\'s payment'
		],
		'mc_handling' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Total handling charge associated with the transaction'
		],
		'mc_shipping' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Total shipping amount associated with the transaction'
		],
		'payment_fee' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'USD transaction fee associated with the payment'
		],
		'payment_gross' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Full USD amount of the customers payment transaction, before payment_fee is subtracted'
		],
		'settle_amount' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount that is deposited into the account\'s primary balance after a currency conversion'
		],
		'settle_currency' => [
			'type' => 'string',
			'length' => 3,
			'null' => true,
			'default' => null,
			'comment' => 'Currency of settle amount. Three digit currency code',
			'precision' => null,
			'fixed' => null
		],
		'auction_buyer_id' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => 'The customer\'s auction ID.',
			'precision' => null,
			'fixed' => null
		],
		'auction_closing_date' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'The auction\'s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
			'precision' => null,
			'fixed' => null
		],
		'auction_multi_item' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'The number of items purchased in multi-item auction payments',
			'precision' => null,
			'autoIncrement' => null
		],
		'for_auction' => [
			'type' => 'string',
			'length' => 10,
			'null' => true,
			'default' => null,
			'comment' => 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
			'precision' => null,
			'fixed' => null
		],
		'subscr_date' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
			'precision' => null,
			'fixed' => null
		],
		'subscr_effective' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Date when a subscription modification becomes effective',
			'precision' => null,
			'fixed' => null
		],
		'period1' => [
			'type' => 'string',
			'length' => 10,
			'null' => true,
			'default' => null,
			'comment' => '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D',
			'precision' => null,
			'fixed' => null
		],
		'period2' => [
			'type' => 'string',
			'length' => 10,
			'null' => true,
			'default' => null,
			'comment' => '(Optional) Trial period',
			'precision' => null,
			'fixed' => null
		],
		'period3' => [
			'type' => 'string',
			'length' => 10,
			'null' => true,
			'default' => null,
			'comment' => 'Regular subscription interval in days, weeks, months, years',
			'precision' => null,
			'fixed' => null
		],
		'amount1' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for Trial period 1 for USD'
		],
		'amount2' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for Trial period 2 for USD'
		],
		'amount3' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for regular subscription  period 1 for USD'
		],
		'mc_amount1' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for trial period 1 regardless of currency'
		],
		'mc_amount2' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for trial period 2 regardless of currency'
		],
		'mc_amount3' => [
			'type' => 'float',
			'length' => 10,
			'precision' => 2,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'Amount of payment for regular subscription period regardless of currency'
		],
		'recurring' => [
			'type' => 'string',
			'length' => 1,
			'null' => true,
			'default' => null,
			'comment' => 'Indicates whether rate recurs (1 is yes, blank is no)',
			'precision' => null,
			'fixed' => null
		],
		'reattempt' => [
			'type' => 'string',
			'length' => 1,
			'null' => true,
			'default' => null,
			'comment' => 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
			'precision' => null,
			'fixed' => null
		],
		'retry_at' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Date PayPal will retry a failed subscription payment',
			'precision' => null,
			'fixed' => null
		],
		'recur_times' => [
			'type' => 'integer',
			'length' => 11,
			'unsigned' => false,
			'null' => true,
			'default' => null,
			'comment' => 'The number of payment installations that will occur at the regular rate',
			'precision' => null,
			'autoIncrement' => null
		],
		'username' => [
			'type' => 'string',
			'length' => 64,
			'null' => true,
			'default' => null,
			'comment' => '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
			'precision' => null,
			'fixed' => null
		],
		'password' => [
			'type' => 'string',
			'length' => 24,
			'null' => true,
			'default' => null,
			'comment' => '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
			'precision' => null,
			'fixed' => null
		],
		'subscr_id' => [
			'type' => 'string',
			'length' => 19,
			'null' => true,
			'default' => null,
			'comment' => 'ID generated by PayPal for the subscriber',
			'precision' => null,
			'fixed' => null
		],
		'case_id' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Case identification number',
			'precision' => null,
			'fixed' => null
		],
		'case_type' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'complaint/chargeback',
			'precision' => null,
			'fixed' => null
		],
		'case_creation_date' => [
			'type' => 'string',
			'length' => 28,
			'null' => true,
			'default' => null,
			'comment' => 'Date/Time the case was registered',
			'precision' => null,
			'fixed' => null
		],
		'created' => [
			'type' => 'datetime',
			'length' => null,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null
		],
		'modified' => [
			'type' => 'datetime',
			'length' => null,
			'null' => true,
			'default' => null,
			'comment' => '',
			'precision' => null
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
		],
		'_options' => [
			'engine' => 'InnoDB',
			'collation' => 'utf8_unicode_ci'
		],
	];
	// @codingStandardsIgnoreEnd

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = [
		[
			'id' => '4d0cf142-245c-4c97-8734-cb965658c9ad',
			'notify_version' => 'Lorem ipsum dolor sit amet',
			'verify_sign' => 'Lorem ipsum dolor sit amet',
			'test_ipn' => 1,
			'address_city' => 'Lorem ipsum dolor sit amet',
			'address_country' => 'Lorem ipsum dolor sit amet',
			'address_country_code' => '',
			'address_name' => 'Lorem ipsum dolor sit amet',
			'address_state' => 'Lorem ipsum dolor sit amet',
			'address_status' => 'Lorem ipsum dolor ',
			'address_street' => 'Lorem ipsum dolor sit amet',
			'address_zip' => 'Lorem ipsum dolor ',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'payer_business_name' => 'Lorem ipsum dolor sit amet',
			'payer_email' => 'Lorem ipsum dolor sit amet',
			'payer_id' => 'Lorem ipsum',
			'payer_status' => 'Lorem ipsum dolor ',
			'contact_phone' => 'Lorem ipsum dolor ',
			'residence_country' => '',
			'business' => 'Lorem ipsum dolor sit amet',
			'item_name' => 'Lorem ipsum dolor sit amet',
			'item_number' => 'Lorem ipsum dolor sit amet',
			'quantity' => 'Lorem ipsum dolor sit amet',
			'item_name1' => 'Lorem ipsum dolor sit amet',
			'item_number1' => 'Lorem ipsum dolor sit amet',
			'quantity1' => 'Lorem ipsum dolor sit amet',
			'receiver_email' => 'Lorem ipsum dolor sit amet',
			'receiver_id' => 'Lorem ipsum',
			'custom' => 'Lorem ipsum dolor sit amet',
			'invoice' => 'Lorem ipsum dolor sit amet',
			'memo' => 'Lorem ipsum dolor sit amet',
			'option_name_1' => 'Lorem ipsum dolor sit amet',
			'option_name_2' => 'Lorem ipsum dolor sit amet',
			'option_selection1' => 'Lorem ipsum dolor sit amet',
			'option_selection2' => 'Lorem ipsum dolor sit amet',
			'tax' => 1,
			'auth_id' => 'Lorem ipsum dolor',
			'auth_exp' => 'Lorem ipsum dolor sit amet',
			'auth_amount' => 1,
			'auth_status' => 'Lorem ipsum dolor ',
			'num_cart_items' => 1,
			'parent_txn_id' => 'Lorem ipsum dolor',
			'payment_date' => 'Lorem ipsum dolor sit amet',
			'payment_status' => 'Lorem ipsum dolor ',
			'payment_type' => 'Lorem ip',
			'pending_reason' => 'Lorem ipsum dolor ',
			'reason_code' => 'Lorem ipsum dolor ',
			'remaining_settle' => 1,
			'shipping_method' => 'Lorem ipsum dolor sit amet',
			'shipping' => 1,
			'transaction_entity' => 'Lorem ipsum dolor ',
			'txn_id' => 'Lorem ipsum dolor',
			'txn_type' => 'Lorem ipsum dolor ',
			'exchange_rate' => 1,
			'mc_currency' => 'L',
			'mc_fee' => 1,
			'mc_gross' => 1,
			'mc_handling' => 1,
			'mc_shipping' => 1,
			'payment_fee' => 1,
			'payment_gross' => 1,
			'settle_amount' => 1,
			'settle_currency' => 'L',
			'auction_buyer_id' => 'Lorem ipsum dolor sit amet',
			'auction_closing_date' => 'Lorem ipsum dolor sit amet',
			'auction_multi_item' => 1,
			'for_auction' => 'Lorem ip',
			'subscr_date' => 'Lorem ipsum dolor sit amet',
			'subscr_effective' => 'Lorem ipsum dolor sit amet',
			'period1' => 'Lorem ip',
			'period2' => 'Lorem ip',
			'period3' => 'Lorem ip',
			'amount1' => 1,
			'amount2' => 1,
			'amount3' => 1,
			'mc_amount1' => 1,
			'mc_amount2' => 1,
			'mc_amount3' => 1,
			'recurring' => 'Lorem ipsum dolor sit ame',
			'reattempt' => 'Lorem ipsum dolor sit ame',
			'retry_at' => 'Lorem ipsum dolor sit amet',
			'recur_times' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit ',
			'subscr_id' => 'Lorem ipsum dolor',
			'case_id' => 'Lorem ipsum dolor sit amet',
			'case_type' => 'Lorem ipsum dolor sit amet',
			'case_creation_date' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-06-04 21:05:49',
			'modified' => '2016-06-04 21:05:49'
		],
	];
}