<?php
use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
	public function up()
	{

        $table = $this->table('instant_payment_notifications', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'uuid')
			->addColumn('notify_version', 'string', [
				'comment' => 'IPN Version Number',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('verify_sign', 'string', [
				'comment' => 'Encrypted string used to verify the authenticity of the transaction',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('test_ipn', 'integer', [
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('address_city', 'string', [
				'comment' => 'City of customers address',
				'default' => null,
				'limit' => 40,
				'null' => true,
			])
			->addColumn('address_country', 'string', [
				'comment' => 'Country of customers address',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('address_country_code', 'string', [
				'comment' => 'Two character ISO 3166 country code',
				'default' => null,
				'limit' => 2,
				'null' => true,
			])
			->addColumn('address_name', 'string', [
				'comment' => 'Name used with address (included when customer provides a Gift address)',
				'default' => null,
				'limit' => 128,
				'null' => true,
			])
			->addColumn('address_state', 'string', [
				'comment' => 'State of customer address',
				'default' => null,
				'limit' => 40,
				'null' => true,
			])
			->addColumn('address_status', 'string', [
				'comment' => 'confirmed/unconfirmed',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('address_street', 'string', [
				'comment' => 'Customer\'s street address',
				'default' => null,
				'limit' => 200,
				'null' => true,
			])
			->addColumn('address_zip', 'string', [
				'comment' => 'Zip code of customer\'s address',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('first_name', 'string', [
				'comment' => 'Customer\'s first name',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('last_name', 'string', [
				'comment' => 'Customer\'s last name',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('payer_business_name', 'string', [
				'comment' => 'Customer\'s company name, if customer represents a business',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('payer_email', 'string', [
				'comment' => 'Customer\'s primary email address. Use this email to provide any credits',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('payer_id', 'string', [
				'comment' => 'Unique customer ID.',
				'default' => null,
				'limit' => 13,
				'null' => true,
			])
			->addColumn('payer_status', 'string', [
				'comment' => 'verified/unverified',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('contact_phone', 'string', [
				'comment' => 'Customer\'s telephone number.',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('residence_country', 'string', [
				'comment' => 'Two-Character ISO 3166 country code',
				'default' => null,
				'limit' => 2,
				'null' => true,
			])
			->addColumn('business', 'string', [
				'comment' => 'Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (If payment is sent to primary account) and business set in the Website Payment HTML.',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('item_name', 'string', [
				'comment' => 'Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, Paypal will append the number of the item (e.g., item_name_1,item_name_2, and so forth).',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('item_number', 'string', [
				'comment' => 'Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you.',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('quantity', 'string', [
				'comment' => 'Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g., quantity1,quantity2).',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('item_name1', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('item_number1', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('quantity1', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('receiver_email', 'string', [
				'comment' => 'Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('receiver_id', 'string', [
				'comment' => 'Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipients referral ID.',
				'default' => null,
				'limit' => 13,
				'null' => true,
			])
			->addColumn('custom', 'string', [
				'comment' => 'Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer.',
				'default' => null,
				'limit' => 255,
				'null' => true,
			])
			->addColumn('invoice', 'string', [
				'comment' => 'Pass through variable you can use to identify your invoice number for this purchase. If omitted, no variable is passed back.',
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('memo', 'string', [
				'comment' => 'Memo as entered by your customer in PayPal Website Payments note field.',
				'default' => null,
				'limit' => 255,
				'null' => true,
			])
			->addColumn('option_name_1', 'string', [
				'comment' => 'Option name 1 as requested by you',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('option_name_2', 'string', [
				'comment' => 'Option 2 name as requested by you',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('option_selection1', 'string', [
				'comment' => 'Option 1 choice as entered by your customer',
				'default' => null,
				'limit' => 200,
				'null' => true,
			])
			->addColumn('option_selection2', 'string', [
				'comment' => 'Option 2 choice as entered by your customer',
				'default' => null,
				'limit' => 200,
				'null' => true,
			])
			->addColumn('tax', 'float', [
				'comment' => 'Amount of tax charged on payment',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('auth_id', 'string', [
				'comment' => 'Authorization identification number',
				'default' => null,
				'limit' => 19,
				'null' => true,
			])
			->addColumn('auth_exp', 'string', [
				'comment' => 'Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('auth_amount', 'integer', [
				'comment' => 'Authorization amount',
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('auth_status', 'string', [
				'comment' => 'Status of authorization',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('num_cart_items', 'integer', [
				'comment' => 'If this is a PayPal shopping cart transaction, number of items in the cart',
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('parent_txn_id', 'string', [
				'comment' => 'In the case of a refund, reversal, or cancelled reversal, this variable contains the txn_id of the original transaction, while txn_id contains a new ID for the new transaction.',
				'default' => null,
				'limit' => 19,
				'null' => true,
			])
			->addColumn('payment_date', 'string', [
				'comment' => 'Time/date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('payment_status', 'string', [
				'comment' => 'Payment status of the payment',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('payment_type', 'string', [
				'comment' => 'echeck/instant',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('pending_reason', 'string', [
				'comment' => 'This variable is only set if payment_status=pending',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('reason_code', 'string', [
				'comment' => 'This variable is only set if payment_status=reversed',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('remaining_settle', 'integer', [
				'comment' => 'Remaining amount that can be captured with Authorization and Capture',
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('shipping_method', 'string', [
				'comment' => 'The name of a shipping method from the shipping calculations section of the merchants account profile. The buyer selected the named shipping method for this transaction',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('shipping', 'float', [
				'comment' => 'Shipping charges associated with this transaction. Format unsigned, no currency symbol, two decimal places',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('transaction_entity', 'string', [
				'comment' => 'Authorization and capture transaction entity',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('txn_id', 'string', [
				'comment' => 'A unique transaction ID generated by PayPal',
				'default' => null,
				'limit' => 19,
				'null' => true,
			])
			->addColumn('txn_type', 'string', [
				'comment' => 'cart/express_checkout/send-money/virtual-terminal/web-accept',
				'default' => null,
				'limit' => 20,
				'null' => true,
			])
			->addColumn('exchange_rate', 'float', [
				'comment' => 'Exchange rate used if a currency conversion occured',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_currency', 'string', [
				'comment' => 'Three character country code. For payment IPN notifications, this is the currency of the payment, for non-payment subscription IPN notifications, this is the currency of the subscription.',
				'default' => null,
				'limit' => 3,
				'null' => true,
			])
			->addColumn('mc_fee', 'float', [
				'comment' => 'Transaction fee associated with the payment, mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either ofthose p',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_gross', 'float', [
				'comment' => 'Full amount of the customer\'s payment',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_handling', 'float', [
				'comment' => 'Total handling charge associated with the transaction',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_shipping', 'float', [
				'comment' => 'Total shipping amount associated with the transaction',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('payment_fee', 'float', [
				'comment' => 'USD transaction fee associated with the payment',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('payment_gross', 'float', [
				'comment' => 'Full USD amount of the customers payment transaction, before payment_fee is subtracted',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('settle_amount', 'float', [
				'comment' => 'Amount that is deposited into the account\'s primary balance after a currency conversion',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('settle_currency', 'string', [
				'comment' => 'Currency of settle amount. Three digit currency code',
				'default' => null,
				'limit' => 3,
				'null' => true,
			])
			->addColumn('auction_buyer_id', 'string', [
				'comment' => 'The customer\'s auction ID.',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('auction_closing_date', 'string', [
				'comment' => 'The auction\'s close date. In the format: HH:MM:SS DD Mmm YY, YYYY PSD',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('auction_multi_item', 'integer', [
				'comment' => 'The number of items purchased in multi-item auction payments',
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('for_auction', 'string', [
				'comment' => 'This is an auction payment - payments made using Pay for eBay Items or Smart Logos - as well as send money/money request payments with the type eBay items or Auction Goods(non-eBay)',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('subscr_date', 'string', [
				'comment' => 'Start date or cancellation date depending on whether txn_type is subcr_signup or subscr_cancel',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('subscr_effective', 'string', [
				'comment' => 'Date when a subscription modification becomes effective',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('period1', 'string', [
				'comment' => '(Optional) Trial subscription interval in days, weeks, months, years (example a 4 day interval is 4 D)',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('period2', 'string', [
				'comment' => '(Optional) Trial period',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('period3', 'string', [
				'comment' => 'Regular subscription interval in days, weeks, months, years',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('amount1', 'float', [
				'comment' => 'Amount of payment for Trial period 1 for USD',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('amount2', 'float', [
				'comment' => 'Amount of payment for Trial period 2 for USD',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('amount3', 'float', [
				'comment' => 'Amount of payment for regular subscription  period 1 for USD',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_amount1', 'float', [
				'comment' => 'Amount of payment for trial period 1 regardless of currency',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_amount2', 'float', [
				'comment' => 'Amount of payment for trial period 2 regardless of currency',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_amount3', 'float', [
				'comment' => 'Amount of payment for regular subscription period regardless of currency',
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('recurring', 'string', [
				'comment' => 'Indicates whether rate recurs (1 is yes, blank is no)',
				'default' => null,
				'limit' => 1,
				'null' => true,
			])
			->addColumn('reattempt', 'string', [
				'comment' => 'Indicates whether reattempts should occur on payment failure (1 is yes, blank is no)',
				'default' => null,
				'limit' => 1,
				'null' => true,
			])
			->addColumn('retry_at', 'string', [
				'comment' => 'Date PayPal will retry a failed subscription payment',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('recur_times', 'integer', [
				'comment' => 'The number of payment installations that will occur at the regular rate',
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('username', 'string', [
				'comment' => '(Optional) Username generated by PayPal and given to subscriber to access the subscription',
				'default' => null,
				'limit' => 64,
				'null' => true,
			])
			->addColumn('password', 'string', [
				'comment' => '(Optional) Password generated by PayPal and given to subscriber to access the subscription (Encrypted)',
				'default' => null,
				'limit' => 24,
				'null' => true,
			])
			->addColumn('subscr_id', 'string', [
				'comment' => 'ID generated by PayPal for the subscriber',
				'default' => null,
				'limit' => 19,
				'null' => true,
			])
			->addColumn('case_id', 'string', [
				'comment' => 'Case identification number',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('case_type', 'string', [
				'comment' => 'complaint/chargeback',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('case_creation_date', 'string', [
				'comment' => 'Date/Time the case was registered',
				'default' => null,
				'limit' => 28,
				'null' => true,
			])
			->addColumn('created', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->addColumn('modified', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => true,
			])
			->create();


		$table = $this->table('paypal_items');
		$table
			->addColumn('instant_payment_notification_id', 'integer', [
				'default' => null,
				'limit' => 11,
				'null' => true,
			])
			->addColumn('item_name', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('item_number', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('quantity', 'string', [
				'default' => null,
				'limit' => 127,
				'null' => true,
			])
			->addColumn('mc_gross', 'float', [
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_shipping', 'float', [
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('mc_handling', 'float', [
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('tax', 'float', [
				'default' => null,
				'limit' => 10,
				'null' => true,
			])
			->addColumn('created', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => false,
			])
			->addColumn('modified', 'datetime', [
				'default' => null,
				'limit' => null,
				'null' => false,
			])
			->create();

	}

	public function down()
	{
		$this->dropTable('instant_payment_notifications');
		$this->dropTable('paypal_items');
	}
}
